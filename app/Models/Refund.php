<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Refund extends Model
{
    protected $fillable = [
        'transaction_id',
        'refunded_by_id',
        'amount',
        'currency',
        'reason',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relaciones
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function refundedBy()
    {
        return $this->belongsTo(User::class, 'refunded_by_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Métodos
    public function canBeRequested()
    {
        return $this->transaction->status === 'completed' && 
               $this->transaction->type === 'send' &&
               $this->status === 'pending';
    }

    public function canBeApproved()
    {
        return $this->status === 'pending';
    }

    public function canBeRejected()
    {
        return $this->status === 'pending';
    }

    public function canBeCompleted()
    {
        return $this->status === 'approved';
    }

    // Estados
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Acciones
    public function approve($approvedBy)
    {
        $this->update([
            'status' => 'approved',
            'refunded_by_id' => $approvedBy->id,
        ]);

        // Crear notificación
        Notification::create([
            'user_id' => $this->transaction->sender_id,
            'title' => 'Reembolso aprobado',
            'message' => "Tu solicitud de reembolso por {$this->currency} {$this->amount} ha sido aprobada.",
            'type' => 'refund',
            'is_active' => true,
            'data' => ['refund_id' => $this->id],
        ]);
    }

    public function reject($rejectedBy, $reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'refunded_by_id' => $rejectedBy->id,
            'reason' => $reason ?: $this->reason,
        ]);

        // Crear notificación
        Notification::create([
            'user_id' => $this->transaction->sender_id,
            'title' => 'Reembolso rechazado',
            'message' => "Tu solicitud de reembolso por {$this->currency} {$this->amount} ha sido rechazada.",
            'type' => 'refund',
            'is_active' => true,
            'data' => ['refund_id' => $this->id],
        ]);
    }

    public function complete()
    {
        $this->update(['status' => 'completed']);

        // Procesar el reembolso
        $transaction = $this->transaction;
        $sender = $transaction->sender;
        $receiver = $transaction->receiver;

        // Revertir la transacción original
        if ($transaction->type === 'send') {
            // Devolver dinero al remitente
            $sender->wallet->increment('balance', $this->amount);
            
            // Quitar dinero al destinatario
            $receiver->wallet->decrement('balance', $transaction->converted_amount ?? $this->amount);

            // Crear transacción de reembolso
            Transaction::create([
                'type' => 'refund',
                'sender_id' => $receiver->id,
                'receiver_id' => $sender->id,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'converted_amount' => $transaction->converted_amount ?? $this->amount,
                'receiver_currency' => $transaction->receiver_currency ?? $this->currency,
                'exchange_rate' => $transaction->exchange_rate ?? 1,
                'reason' => "Reembolso: {$this->reason}",
                'status' => 'completed',
            ]);

            // Notificaciones
            Notification::create([
                'user_id' => $sender->id,
                'title' => 'Reembolso completado',
                'message' => "Has recibido {$this->currency} {$this->amount} como reembolso.",
                'type' => 'refund',
                'is_active' => true,
                'data' => ['refund_id' => $this->id],
            ]);

            Notification::create([
                'user_id' => $receiver->id,
                'title' => 'Reembolso procesado',
                'message' => "Se ha procesado un reembolso de {$this->currency} {$this->amount}.",
                'type' => 'refund',
                'is_active' => true,
                'data' => ['refund_id' => $this->id],
            ]);
        }
    }
} 