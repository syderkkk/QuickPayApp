<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank_accounts';
    
    protected $fillable = [
        'user_id',
        'bank_name',
        'swift_code',
        'account_type',
        'account_number',
        'currency',
        'document_number',
        'phone',
        'billing_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
