<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Refund;

class RefundController extends Controller
{
    // Muestra el formulario de reembolso
    public function create($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)
            ->where('sender_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();

        return view('refunds.create', compact('transaction'));
    }

    public function store(Request $request, $transactionId)
    {
        $request->validate([
            'reason_type' => 'required',
            'description' => 'nullable|string|max:500',
        ]);

        $transaction = Transaction::where('id', $transactionId)
            ->where('sender_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();

        // Evitar duplicados
        if ($transaction->hasPendingRefund() || $transaction->hasApprovedRefund()) {
            return redirect()->route('transactions.index')
                ->with('error', 'Ya existe una solicitud de reembolso para esta transacción.');
        }

        $motivos = [
            'no_recibido' => 'Producto/servicio no recibido',
            'error_monto' => 'Error en el monto',
            'no_reconozco' => 'No reconozco esta transacción',
            'otro' => 'Otro',
        ];
        $motivo = $motivos[$request->reason_type] ?? 'Otro';

        $refund = new Refund();
        $refund->transaction_id = $transaction->id;
        $refund->amount = $transaction->amount;
        $refund->currency = $transaction->currency;
        $refund->reason = $motivo . ($request->description ? (': ' . $request->description) : '');
        $refund->status = 'pending';
        $refund->save();

        // Notificar al receptor
        Notification::create([
            'user_id' => $transaction->receiver_id,
            'title' => 'Nueva solicitud de reembolso',
            'message' => 'Has recibido una solicitud de reembolso de ' . $transaction->sender->name . ' ' . $transaction->sender->lastname . '.',
            'type' => 'refund',
            'is_active' => true,
            'data' => [
                'refund_id' => $refund->id,
                'transaction_id' => $transaction->id,
            ],
        ]);

        return view('refunds.confirm');
    }

    public function accept($refundId)
    {
        $refund = Refund::with('transaction')->findOrFail($refundId);
        $user = Auth::user();

        // Solo el receptor puede aceptar
        if ($refund->transaction->receiver_id !== $user->id) {
            abort(403);
        }

        // Solo si está pendiente
        if ($refund->status !== 'pending') {
            return back()->with('error', 'El reembolso ya fue procesado.');
        }

        // Transferir el dinero de vuelta al remitente
        $sender = $refund->transaction->sender;
        $receiver = $refund->transaction->receiver;
        $amount = $refund->amount;

        // Validar que el receptor tenga saldo suficiente
        if ($receiver->wallet->balance < $amount) {
            return back()->with('error', 'Saldo insuficiente para procesar el reembolso.');
        }

        DB::transaction(function () use ($receiver, $sender, $amount, $refund) {
            $receiver->wallet->decrement('balance', $amount);
            $sender->wallet->increment('balance', $amount);
            $refund->status = 'completed';
            $refund->save();
        });

        return back()->with('success', 'Reembolso aceptado y procesado correctamente.');
    }

    public function reject($refundId)
    {
        $refund = Refund::with('transaction')->findOrFail($refundId);
        $user = Auth::user();

        // Solo el receptor puede rechazar
        if ($refund->transaction->receiver_id !== $user->id) {
            abort(403);
        }

        // Solo si está pendiente
        if ($refund->status !== 'pending') {
            return back()->with('error', 'El reembolso ya fue procesado.');
        }

        $refund->status = 'rejected';
        $refund->save();

        return back()->with('success', 'Reembolso rechazado correctamente.');
    }
} 