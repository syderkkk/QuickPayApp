<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Transacciones recientes
        $transactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Contactos frecuentes (ejemplo: usuarios con más transacciones)
        /* $contacts = User::where('id', '!=', $user->id)
            ->withCount(['sentTransactions' => function ($q) use ($user) {
                $q->where('sender_id', $user->id);
            }])
            ->orderByDesc('sent_transactions_count')
            ->take(5)
            ->get(); */

        // Tarjetas asociadas (ajusta según tu modelo)
        /* $cards = $user->cards ?? []; */

        /* return view('dashboard', compact('transactions', 'contacts', 'cards')); */
        return view('dashboard', compact('transactions'));
    }
}
