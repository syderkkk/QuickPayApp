<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = [
        'custom_id',
        'type',
        'sender_id',
        'receiver_id',
        'amount',
        'currency',
        'reason',
        'status',
        'converted_amount',
        'receiver_currency',
        'exchange_rate',

    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    protected static function booted()
    {
        static::creating(function ($transaction) {
            if (empty($transaction->custom_id)) {
                do {
                    $customId = strtoupper(Str::random(12));
                } while (Transaction::where('custom_id', $customId)->exists());
                $transaction->custom_id = $customId;
            }
        });
    }
}
