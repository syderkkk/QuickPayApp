<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $query = Refund::with(['transaction.sender', 'transaction.receiver'])
            ->orderByDesc('created_at');

        // Filtro por nombre/correo del solicitante o destinatario
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('transaction.sender', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('lastname', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%") ;
            })->orWhereHas('transaction.receiver', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('lastname', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%") ;
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtro por monto mínimo
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->input('min_amount'));
        }
        // Filtro por monto máximo
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->input('max_amount'));
        }

        // Filtro por fecha desde
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        // Filtro por fecha hasta
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $refunds = $query->paginate(10)->withQueryString();
        return view('admin.refunds.index', compact('refunds'));
    }

    public function show($id)
    {
        $refund = Refund::with(['transaction.sender', 'transaction.receiver'])->findOrFail($id);
        return view('admin.refunds.show', compact('refund'));
    }
} 