<?php

namespace App\Models\Simulation;

use Illuminate\Database\Eloquent\Model;

class AvailableBankAccount extends Model
{
    protected $table = 'S_available_bank_accounts';

    protected $fillable = [
        'bank_entity_id',
        'account_number',
        'type',
        'currency',
        'balance',
        'status',
    ];

    public function bankEntity()
    {
        return $this->belongsTo(BankEntity::class, 'bank_entity_id');
    }

    public function availableCards()
    {
        return $this->hasMany(AvailableCard::class, 'available_bank_account_id');
    }
}
