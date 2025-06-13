<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['sender', 'receiver']);

        // Filtros

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search);
            });
        }
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        $transactions = $query->latest()->paginate(9);

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::with(['sender', 'receiver'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cambiar estado: Completado, Pendiente, Cancelado, Reembolsado
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
