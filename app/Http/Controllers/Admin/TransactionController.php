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

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por tipo: recibido o enviado
        if ($request->filled('type')) {
            if ($request->type === 'receive') {
                // Solo mostrar transacciones donde el usuario buscado es receiver
                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->whereHas('receiver', function ($q) use ($search) {
                        $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }
            } elseif ($request->type === 'send') {
                // Solo mostrar transacciones donde el usuario buscado es sender
                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->whereHas('sender', function ($q) use ($search) {
                        $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }
            }
        } else {
            // Si no se selecciona tipo, buscar en ambos (sender y receiver)
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('sender', function ($q2) use ($search) {
                        $q2->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                        ->orWhereHas('receiver', function ($q2) use ($search) {
                            $q2->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            }
        }

        // Filtro por monto mínimo
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        // Filtro por monto máximo
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
        // Filtro por rango de fechas
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        // Filtro por moneda
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        $transactions = $query->latest()->paginate(5);

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
        $transaction = Transaction::findOrFail($id);

        // Solo permitir cancelar si está pendiente
        if ($transaction->status === 'pending' && $request->status === 'cancelled') {
            $transaction->status = 'cancelled';
            $transaction->save();

            return redirect()->route('admin.transactions.show', $transaction->id)
                ->with('success', 'Transacción cancelada correctamente.');
        }

        return back()->with('error', 'Solo se puede cancelar una transacción pendiente.');
    }
}
