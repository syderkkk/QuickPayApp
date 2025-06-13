<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalBalance = Wallet::sum('balance');
        $totalTransactions = Transaction::count();

        $transactions = Transaction::with('sender')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBalance',
            'totalTransactions',
            'transactions',
        ));
    }
}
