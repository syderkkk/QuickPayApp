<?php

namespace App\Models;

use App\Models\Simulation\AvailableBankAccount;
use App\Models\Simulation\AvailableCard;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'card_holder',
        'brand',
        'last_four',
        'nickname',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availableBankAccount()
    {
        return $this->belongsTo(AvailableBankAccount::class, 'available_bank_account_id');
    }
}
