<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function step1()
    {
        return view('transactions.request.step1');
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
                ->route('transactions.request.step1')
                ->withInput()
                ->withErrors(['receiver' => 'No puedes solicitarte dinero a ti mismo.']);
        }

        $wallet = $user->wallet;

        return view('transactions.request.step2', [
            'receiver' => $receiver,
            'wallet_currency' => $wallet->currency,
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

        $user = Auth::user();
        $receiver = User::findOrFail($request->receiver_id);

        if ($user->id === $receiver->id) {
            return redirect()
                ->route('transactions.request.step1')
                ->withInput()
                ->withErrors(['receiver' => 'No puedes solicitarte dinero a ti mismo.']);
        }


        DB::transaction(function () use ($user, $receiver, $request) {

            $transaction = Transaction::create([
                'type' => 'request',
                'sender_id' => $receiver->id,
                'receiver_id' => $user->id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'converted_amount' => null,
                'receiver_currency' => $receiver->wallet->currency,
                'exchange_rate' => null,
                'reason' => $request->reason,
                'status' => 'pending',
            ]);

            Notification::create([
                'user_id' => $receiver->id,
                'title' => 'Nueva solicitud de dinero',
                'message' => "Has recibido una solicitud de {$request->currency} {$request->amount} de {$user->name} {$user->lastname}.",
                'type' => 'request',
                'is_active' => true,
                'data' => ['request_id' => $transaction->id],
            ]);
        });

        return view('transactions.request.confirm', [
            'receiver' => $receiver,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'type' => 'request',
        ]);
    }


    public function show($id)
    {
        $user = Auth::user();

        $transaction = Transaction::where('id', $id)
            ->where('type', 'request')
            ->where(function ($q) use ($user) {
                $q->where('receiver_id', $user->id)
                    ->orWhere('sender_id', $user->id);
            })
            ->firstOrFail();

        $requester = $transaction->receiver; // Quien solicita el dinero
        $payer = $transaction->sender;       // Quien va a pagar el dinero

        // Determinar qué usuario está viendo la solicitud
        $isRequester = (Auth::id() === $transaction->receiver_id);
        $isPayer = (Auth::id() === $transaction->sender_id);

        // Configurar conversión solo para el que va a pagar
        $showConversion = false;
        $convertedAmount = null;
        $exchangeRate = null;
        $payerCurrency = $payer->wallet->currency;
        $requesterCurrency = $transaction->currency;

        // Solo mostrar conversión si las monedas son diferentes Y el usuario es quien va a pagar
        if ($isPayer && $requesterCurrency !== $payerCurrency) {
            $showConversion = true;

            // Calcular conversión: de moneda del solicitante a moneda del pagador
            if ($transaction->converted_amount && $transaction->exchange_rate) {
                $convertedAmount = $transaction->converted_amount;
                $exchangeRate = $transaction->exchange_rate;
            } else {
                $exchangeRate = ExchangeRateService::getExchangeRate($requesterCurrency, $payerCurrency);

                if ($exchangeRate) {
                    $convertedAmount = $transaction->amount * $exchangeRate;
                }
            }
        }

        $wallet_currency = null;
        $wallet_balance = null;
        $cards = [];

        if ($isPayer) {
            $wallet_currency = $payer->wallet->currency ?? 'PEN';
            $wallet_balance = $payer->wallet->balance ?? 0;
            $cards = $payer->cards()->where('status', 'active')->get();
        }

        return view('transactions.request.show', compact(
            'transaction',
            'requester',
            'payer',
            'isRequester',
            'isPayer',
            'showConversion',
            'convertedAmount',
            'exchangeRate',
            'payerCurrency',
            'requesterCurrency',
            'wallet_currency',
            'wallet_balance',
            'cards',
        ));
    }

    public function accept(Request $request, $id)
    {
        $user = Auth::user();

        $transaction = Transaction::where('id', $id)
            ->where('type', 'request')
            ->where('sender_id', $user->id) // Solo el pagador puede aceptar
            ->where('status', 'pending')
            ->firstOrFail();

        $request->validate([
            'from_account' => 'required|string',
        ]);

        $payer = $user;
        $requester = $transaction->receiver;

        $payerWallet = $payer->wallet;
        $requesterWallet = $requester->wallet;

        $amount = $transaction->amount;
        $currency = $transaction->currency;
        $payerCurrency = $payerWallet->currency;
        $exchangeRate = 1;
        $convertedAmount = $amount;

        // Si las monedas son diferentes, calcula la conversión
        if ($payerCurrency !== $currency) {
            $exchangeRate = \App\Services\ExchangeRateService::getExchangeRate($currency, $payerCurrency);
            if (!$exchangeRate) {
                return back()->withErrors(['from_account' => 'No se pudo obtener la tasa de cambio. Inténtalo más tarde.']);
            }
            $convertedAmount = $amount * $exchangeRate;
        }

        // Procesar según el método de pago
        if ($request->from_account === 'wallet') {
            if ($payerWallet->balance < $convertedAmount) {
                return back()->withErrors(['from_account' => 'Saldo insuficiente en tu billetera.']);
            }

            DB::transaction(function () use ($payerWallet, $requesterWallet, $convertedAmount, $amount, $transaction, $exchangeRate, $currency, $payerCurrency) {
                $payerWallet->decrement('balance', $convertedAmount);
                $requesterWallet->increment('balance', $amount);

                $transaction->status = 'completed';
                $transaction->converted_amount = $convertedAmount;
                $transaction->exchange_rate = $exchangeRate;
                $transaction->save();

                Notification::create([
                    'user_id' => $transaction->receiver_id,
                    'title' => 'Solicitud aceptada',
                    'message' => "Tu solicitud de {$transaction->currency} {$transaction->amount} fue pagada.",
                    'type' => 'request',
                    'is_active' => true,
                    'data' => ['request_id' => $transaction->id],
                ]);
            });
        } elseif (str_starts_with($request->from_account, 'card_')) {
            $cardId = (int)str_replace('card_', '', $request->from_account);

            $card = Card::where('id', $cardId)
                ->where('user_id', $payer->id)
                ->where('status', 'active')
                ->first();

            if (!$card) {
                return back()->withErrors(['from_account' => 'Tarjeta no encontrada o no asociada a tu cuenta.']);
            }

            // Simula el cobro a la tarjeta (puedes usar tu PaymentGatewayService aquí)
            $gateway = app(\App\Services\PaymentGatewayService::class);
            try {
                $gateway->charge($card->token, $convertedAmount);
            } catch (\Exception $e) {
                return back()->withErrors(['from_account' => $e->getMessage()]);
            }

            DB::transaction(function () use ($requesterWallet, $amount, $transaction, $exchangeRate, $convertedAmount, $cardId) {
                $requesterWallet->increment('balance', $amount);

                $transaction->status = 'completed';
                $transaction->converted_amount = $convertedAmount;
                $transaction->exchange_rate = $exchangeRate;
                $transaction->card_id = $cardId;
                $transaction->save();

                Notification::create([
                    'user_id' => $transaction->receiver_id,
                    'title' => 'Solicitud aceptada',
                    'message' => "Tu solicitud de {$transaction->currency} {$transaction->amount} fue pagada.",
                    'type' => 'request',
                    'is_active' => true,
                    'data' => ['request_id' => $transaction->id],
                ]);
            });
        } else {
            return back()->withErrors(['from_account' => 'Método de pago no válido.']);
        }

        return redirect()->route('transactions.request.show', $transaction->id)
            ->with('success', 'Solicitud pagada correctamente.');
    }


    public function reject(Request $request, $id)
    {
        $user = Auth::user();

        $transaction = Transaction::where('id', $id)
            ->where('type', 'request')
            ->where('sender_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $transaction->status = 'cancelled';
        $transaction->save();

        Notification::create([
            'user_id' => $transaction->receiver_id,
            'title' => 'Solicitud rechazada',
            'message' => "Tu solicitud de {$transaction->currency} {$transaction->amount} fue rechazada.",
            'type' => 'request',
            'is_active' => true,
            'data' => ['request_id' => $transaction->id],
        ]);

        return redirect()->route('transactions.request.show', $transaction->id)
            ->with('success', 'Solicitud rechazada correctamente.');
    }
}
