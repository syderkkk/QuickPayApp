<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
        $wallet = $user->wallet;
        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet->balance,
            'wallet_currency' => $wallet->currency,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'type' => 'required|in:send,request,withdraw,card_payment',
            'receiver_id' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'reason' => 'nullable|string|max:255',
        ]);

        $sender = Auth::user();
        $type = $request->type;

        if ($type === 'send') {
            $receiver = User::findOrFail($request->receiver_id);
            if ($sender->wallet->currency !== $request->currency) {
                return back()->withErrors(['currency' => 'Moneda no válida para tu cuenta.']);
            }
            if ($sender->wallet->balance < $request->amount) {
                return back()->withErrors(['amount' => 'Saldo insuficiente.']);
            }

            DB::transaction(function () use ($sender, $receiver, $request) {
                $sender->wallet->decrement('balance', $request->amount);
                $receiver->wallet->increment('balance', $request->amount);
                Transaction::create([
                    'type' => 'send',
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'reason' => $request->reason,
                    'status' => 'completed',
                ]);
            });
        }

        if ($type === 'request') {
            Transaction::create([
                'type' => 'request',
                'sender_id' => $sender->id,
                'receiver_id' => $request->receiver_id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'reason' => $request->reason,
                'status' => 'pending',
            ]);
        }

        if ($type === 'withdraw') {
            if ($sender->wallet->balance < $request->amount) {
                return back()->withErrors(['amount' => 'Saldo insuficiente.']);
            }
            // Aquí iría la lógica de integración bancaria real
            $sender->wallet->decrement('balance', $request->amount);
            Transaction::create([
                'type' => 'withdraw',
                'sender_id' => $sender->id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'reason' => $request->reason,
                'status' => 'pending',
            ]);
        }

        if ($type === 'card_payment') {
            // Aquí iría la lógica de integración con pasarela de pago
            Transaction::create([
                'type' => 'card_payment',
                'sender_id' => $sender->id,
                'receiver_id' => $request->receiver_id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'reason' => $request->reason,
                'status' => 'completed',
            ]);
        }

        return view('transactions.send.confirm', [
            'receiver' => $request->receiver_id ? User::find($request->receiver_id) : null,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'type' => $type,
        ]);
    }
}
