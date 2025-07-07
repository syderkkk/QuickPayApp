<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
            })
            ->where('type', '!=', 'request') // Excluir solicitudes de pago
            ->where('status', 'completed'); // Solo transacciones completadas

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


    public function downloadReceipt($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where(function ($q) {
                $q->where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->firstOrFail();

        // Generar el PDF
        $pdf = Pdf::loadView('transactions.receipt', compact('transaction'));

        // Configurar el PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        // Generar nombre del archivo
        $fileName = 'comprobante-' . $transaction->id . '-' . date('Y-m-d') . '.pdf';

        // Descargar el PDF
        return $pdf->download($fileName);
    }

    public function requestRefund(Request $request, $id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('sender_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();


        return response()->json(['success' => true, 'message' => 'Solicitud de reembolso enviada']);
    }
}
