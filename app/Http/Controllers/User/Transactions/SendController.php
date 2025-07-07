<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Services\BankService;
use App\Services\ExchangeRateService;
use App\Services\PaymentGatewayService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendController extends Controller
{
    public function step1()
    {
        return view('transactions.send.step1');
    }

    public function step2(Request $request)
    {
        $request->validate([
            'receiver' => 'required|email|exists:users,email',
        ]);

        $receiver = User::where('email', $request->receiver)->firstOrFail();
        $user = Auth::user();

        if ($receiver->id === $user->id) {
            return redirect()
                ->route('transactions.send.step1')
                ->withInput()
                ->withErrors(['receiver' => 'No puedes enviarte dinero a ti mismo.']);
        }

        $wallet = $user->wallet;
        $receiverWallet = $receiver->wallet;

        $exchangeRate = 1;
        $convertedAmount = null;

        if ($wallet->currency !== $receiverWallet->currency) {
            $exchangeRate = ExchangeRateService::getExchangeRate($wallet->currency, $receiverWallet->currency);
            if (!$exchangeRate) {
                return redirect()
                    ->route('transactions.send.step1')
                    ->withInput()
                    ->withErrores(['receiver' => 'No se pudo obtener la tasa de cambio. Inténtalo más tarde.']);
            }
        }

        $cards = Card::where('user_id', $user->id)
            ->where('status', 'enabled')
            ->get();

        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet->balance,
            'wallet_currency' => $wallet->currency,
            'receiver_currency' => $receiverWallet->currency,
            'exchange_rate' => $exchangeRate,
            'currencies_different' => $wallet->currency !== $receiverWallet->currency,
            'cards' => $cards,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'reason' => 'nullable|string|max:255',
            'from_account' => 'required|string',
        ]);

        $sender = Auth::user();
        $receiver = User::findOrFail($request->receiver_id);

        // Validar moneda
        if ($sender->wallet->currency !== $request->currency) {
            return redirect()
                ->route('transactions.send.step2', [
                    'receiver' => $receiver->email,
                ])
                ->withInput()
                ->withErrors(['currency' => 'Moneda no válida para tu cuenta.']);
        }

        $senderAmount = $request->amount;
        $receiverAmount = $senderAmount;
        $exchangeRate = 1;

        if ($sender->wallet->currency !== $receiver->wallet->currency) {
            $exchangeRate = ExchangeRateService::getExchangeRate($sender->wallet->currency, $receiver->wallet->currency);

            if (!$exchangeRate) {
                return redirect()
                    ->route('transactions.send.step2', [
                        'receiver' => $receiver->email,
                    ])
                    ->withInput()
                    ->withErrors(['amount' => 'No se pudo obtener la tasa de cambio. Inténtalo más tarde.']);
            }

            $receiverAmount = $senderAmount * $exchangeRate;
        }

        // Determinar el origen de fondos
        if ($request->from_account === 'wallet') {
            if ($sender->wallet->balance < $senderAmount) {
                return redirect()
                    ->route('transactions.send.step2', [
                        'receiver' => $receiver->email,
                    ])
                    ->withInput()
                    ->withErrors(['amount' => 'Saldo insuficiente en tu billetera.']);
            }

            // Transacción desde wallet
            DB::transaction(function () use ($sender, $receiver, $senderAmount, $receiverAmount, $request, $exchangeRate) {
                $sender->wallet->decrement('balance', $senderAmount);
                $receiver->wallet->increment('balance', $receiverAmount);

                Transaction::create([
                    'type' => 'send',
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'converted_amount' => $receiverAmount,
                    'receiver_currency' => $receiver->wallet->currency,
                    'exchange_rate' => $exchangeRate,
                    'reason' => $request->reason,
                    'status' => 'completed',
                ]);

                Notification::create([
                    'user_id' => $receiver->id,
                    'title' => 'Nuevo envío de dinero',
                    'message' => "Has recibido S/.{$receiverAmount} de {$sender->name} {$sender->lastname}.",
                    'type' => 'payment',
                    'is_active' => true,
                ]);
            });
        } elseif (str_starts_with($request->from_account, 'card_')) {
            $cardId = (int)str_replace('card_', '', $request->from_account);
            
            $card = Card::where('user_id', $sender->id)
                ->where('id', $cardId)
                ->where('status', 'enabled')
                ->first();

            if (!$card) {
                return redirect()
                    ->route('transactions.send.step2', [
                        'receiver' => $receiver->email,
                    ])
                    ->withInput()
                    ->withErrors(['from_account' => 'Tarjeta no encontrada o no asociada a tu cuenta.']);
            }

            // Intentar cobrar desde la cuenta bancaria simulada asociada a la tarjeta
            $gateway = app(PaymentGatewayService::class);
            try {
                $gateway->charge($card->token, $senderAmount);
            } catch (Exception $e) {
                return redirect()
                    ->route('transactions.send.step2', [
                        'receiver' => $receiver->email,
                    ])
                    ->withInput()
                    ->withErrors(['from_account' => $e->getMessage()]);
            }

            // Transacción exitosa, acreditar al receiver
            DB::transaction(function () use ($receiver, $receiverAmount, $request, $exchangeRate, $sender, $cardId) {
                $receiver->wallet->increment('balance', $receiverAmount);

                Transaction::create([
                    'type' => 'send',
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'converted_amount' => $receiverAmount,
                    'receiver_currency' => $receiver->wallet->currency,
                    'exchange_rate' => $exchangeRate,
                    'reason' => $request->reason,
                    'status' => 'completed',
                    'card_id' => $cardId,
                ]);

                Notification::create([
                    'user_id' => $receiver->id,
                    'title' => 'Nuevo envío de dinero',
                    'message' => "Has recibido S/.{$receiverAmount} de {$sender->name} {$sender->lastname}.",
                    'type' => 'payment',
                    'is_active' => true,
                ]);
            });
        } else {
            return redirect()
                ->route('transactions.send.step2', [
                    'receiver' => $receiver->email,
                ])
                ->withInput()
                ->withErrors(['from_account' => 'Método de pago no válido.']);
        }

        return view('transactions.send.confirm', [
            'receiver' => $receiver,
            'sender_amount' => $senderAmount,
            'receiver_amount' => $receiverAmount,
            'sender_currency' => $request->currency,
            'receiver_currency' => $receiver->wallet->currency,
            'exchange_rate' => $exchangeRate,
            'type' => 'send',
        ]);
    }
}
