<?php

namespace App\Models\Simulation;

use Illuminate\Database\Eloquent\Model;

class BankEntity extends Model
{
    protected $table = 'S_bank_entities';

    protected $fillable = [
        'nombre',
        'codigo',
    ];

    public function availableBankAccounts()
    {
        return $this->hasMany(AvailableBankAccount::class, 'bank_entity_id');
    }
}
