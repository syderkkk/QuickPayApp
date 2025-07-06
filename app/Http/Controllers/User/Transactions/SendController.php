<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
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
            $exchangeRate = $this->getExchangeRate($wallet->currency, $receiverWallet->currency);
            if (!$exchangeRate) {
                return redirect()
                    ->route('transactions.send.step1')
                    ->withInput()
                    ->withErrores(['receiver' => 'No se pudo obtener la tasa de cambio. Inténtalo más tarde.']);
            }
        }

        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet->balance,
            'wallet_currency' => $wallet->currency,
            'receiver_currency' => $receiverWallet->currency,
            'exchange_rate' => $exchangeRate,
            'currencies_different' => $wallet->currency !== $receiverWallet->currency,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'reason' => 'nullable|string|max:255',
        ]);

        $sender = Auth::user();
        $receiver = User::findOrFail($request->receiver_id);

        if ($sender->wallet->currency !== $request->currency) {
            return redirect()
                ->route('transactions.send.step2', [
                    'receiver' => $receiver->email,
                ])
                ->withInput()
                ->withErrors(['currency' => 'Moneda no válida para tu cuenta.']);
        }

        if ($sender->wallet->balance < $request->amount) {
            return redirect()
                ->route('transactions.send.step2', [
                    'receiver' => $receiver->email,
                ])
                ->withInput()
                ->withErrors(['amount' => 'Saldo insuficiente.']);
        }

        $senderAmount = $request->amount;
        $receiverAmount = $senderAmount;
        $exchangeRate = 1;

        if ($sender->wallet->currency !== $receiver->wallet->currency) {
            $exchangeRate = $this->getExchangeRate($sender->wallet->currency, $receiver->wallet->currency);

            if (!$exchangeRate) {
                return redirect()
                    ->route('transactions.send.step2', [
                        'receiver' => $receiver->email,
                    ])
                    ->withInput()
                    ->withErrores(['amount' => 'No se pudo obtener la tasa de cambio. Inténtalo más tarde.']);
            }

            $receiverAmount = $senderAmount * $exchangeRate;
        }

        DB::transaction(function () use ($sender, $receiver, $request, $senderAmount, $receiverAmount, $exchangeRate) {
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

    public function selectContact()
    {
        $userId = Auth::id();

        $contacts = DB::table('contacts')
            ->join('users', 'contacts.contact_id', '=', 'users.id')
            ->where('contacts.user_id', $userId)
            ->select(
                'contacts.id as contact_relation_id',
                'contacts.alias',
                'users.id as user_id',
                'users.name',
                'users.lastname',
                'users.email'
            )
            ->get();

        return view('transactions.contacts.select', compact('contacts'));
    }

    public function sendToContact($receiverId)
    {
        $receiver = User::findOrFail($receiverId);

        $wallet_balance = Auth::user()->wallet->balance ?? 0;
        $wallet_currency = 'S/.';

        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet_balance,
            'wallet_currency' => $wallet_currency,
        ]);
    }

    private function getExchangeRate($fromCurrency, $toCurrency)
    {
        try {

            $response = Http::timeout(10)->get("https://api.exchangerate-api.com/v4/latest/{$fromCurrency}");

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['rates'][$toCurrency])) {
                    return round($data['rates'][$toCurrency], 4);
                }
            }
        } catch (Exception $e) {
            Log::error('Error getting exchange rate: ' . $e->getMessage());
        }
        return null;
    }
}
