<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Transacciones recientes
        $transactions = Transaction::where(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->where('status', 'completed')
            ->where('type', '!=', 'request')
            ->latest()
            ->take(3)
            ->get();

        // Contactos frecuentes - usuarios a los que más dinero se ha enviado
        $frequentContacts = DB::table('transactions')
            ->join('users', 'transactions.receiver_id', '=', 'users.id')
            ->where('transactions.sender_id', $user->id)
            ->where('transactions.status', 'completed')
            ->where('transactions.type', '!=', 'request')
            ->select(
                'users.id',
                'users.name',
                'users.lastname',
                'users.email',
                DB::raw('COUNT(*) as transaction_count'),
                DB::raw('SUM(transactions.amount) as total_sent'),
                DB::raw('MAX(transactions.created_at) as last_transaction')
            )
            ->groupBy('users.id', 'users.name', 'users.lastname', 'users.email')
            ->orderByDesc('transaction_count')
            ->orderByDesc('last_transaction')
            ->take(5)
            ->get();

        return view('dashboard', compact('transactions', 'frequentContacts'));
    }
}
