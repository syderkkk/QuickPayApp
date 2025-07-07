<?php

namespace App\Models;

use App\Models\Simulation\AvailableCard;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'card_holder',
        'expiry_month',
        'expiry_year',
        'brand',
        'last_four',
        'nickname',
        'available_card_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availableCard()
    {
        return $this->belongsTo(AvailableCard::class, 'available_card_id');
    }
}
