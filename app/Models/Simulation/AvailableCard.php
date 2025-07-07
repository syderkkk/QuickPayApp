<?php

namespace App\Models\Simulation;

use Illuminate\Database\Eloquent\Model;

class AvailableCard extends Model
{
    protected $table = 'S_available_cards';

    protected $fillable = [
        'number',
        'brand',
        'last_four',
        'bank_entity_id',
        'status',
        'cvv',
        'expiry_month',
        'expiry_year',
    ];

    public function bankEntity()
    {
        return $this->belongsTo(BankEntity::class);
    }

    public function availableBankAccount()
    {
        return $this->belongsTo(AvailableBankAccount::class, 'available_bank_account_id');
    }
}
