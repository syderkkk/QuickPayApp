<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();

        $wallets = Wallet::select('balance', 'currency')->get();

        $totalBalancePEN = 0;
        foreach ($wallets as $wallet) {
            if ($wallet->currency === 'PEN') {
                $totalBalancePEN += $wallet->balance;
            } else {
                $rate = ExchangeRateService::getExchangeRate($wallet->currency, 'PEN');
                if ($rate) {
                    $totalBalancePEN += $wallet->balance * $rate;
                }
            }
        }

        $transactions = Transaction::with('sender')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBalancePEN',
            'totalTransactions',
            'transactions',
        ));
    }
}
