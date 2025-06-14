<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Wallet::with('user');

        // Filtro por usuario (nombre o correo)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por moneda
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        // Filtro por saldo mínimo
        if ($request->filled('min_balance')) {
            $query->where('balance', '>=', $request->min_balance);
        }

        // Filtro por saldo máximo
        if ($request->filled('max_balance')) {
            $query->where('balance', '<=', $request->max_balance);
        }

        $wallets = $query->paginate(10);

        return view('admin.wallets.index', compact('wallets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wallet = Wallet::with('user')->findOrFail($id);
        return view('admin.wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $validated = $request->validate([
            'balance' => 'required|numeric|min:0',
            'currency' => 'required|in:PEN,USD,MXN', // agrega más si es necesario
        ]);

        $wallet->balance = $validated['balance'];
        $wallet->currency = $validated['currency'];
        $wallet->save();

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet actualizada correctamente.');
    }
}
