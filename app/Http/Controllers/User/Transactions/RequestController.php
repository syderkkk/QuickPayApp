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

        // Definir roles claramente
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
                $exchangeRate = $this->getExchangeRate($requesterCurrency, $payerCurrency);
                if ($exchangeRate) {
                    $convertedAmount = $transaction->amount * $exchangeRate;
                }
            }
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
            'requesterCurrency'
        ));
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
