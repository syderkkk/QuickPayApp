<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Transaction::query()
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            });

        // Filtros
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reason', 'like', "%$search%")
                    ->orWhere('amount', 'like', "%$search%");
            });
        }

        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        $transactions = $query->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

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


    public function selectContact()
    {
        $userId = Auth::id();

        // Extrae los contactos directamente con join
        $contacts = DB::table('contacts')
            ->join('users', 'contacts.contact_id', '=', 'users.id')
            ->where('contacts.user_id', $userId)
            ->select(
                'contacts.id as contact_relation_id',
                'contacts.alias',
                'users.id as user_id',
                'users.name',
                'users.lastname',
                'users.email' // <-- Agrega este campo
            )
            ->get();

        return view('transactions.contacts.select', compact('contacts'));
    }

    public function sendToContact($receiverId)
    {
        $receiver = User::findOrFail($receiverId);

        // Aquí puedes cargar el saldo, cuentas, etc. según tu lógica actual
        $wallet_balance = Auth::user()->wallet->balance ?? 0;
        $wallet_currency = 'S/.'; // O la moneda que uses

        return view('transactions.send.step2', [
            'receiver' => $receiver,
            'wallet_balance' => $wallet_balance,
            'wallet_currency' => $wallet_currency,
            // ...otros datos necesarios...
        ]);
    }
}
