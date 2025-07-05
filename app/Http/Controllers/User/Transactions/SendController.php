<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet->balance,
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

        return view('transactions.send.confirm', [
            'receiver' => $receiver,
            'amount' => $request->amount,
            'currency' => $request->currency,
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
}
