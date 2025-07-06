<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $transactions = \App\Models\Transaction::where(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->where('status', 'completed')
            ->where('type', '!=', 'request')
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact('transactions'));
    }
}
