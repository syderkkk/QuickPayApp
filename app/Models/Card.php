<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'card_holder',
        'card_number',
        'expiry_month',
        'expiry_year',
        'brand',
        'last_four',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
