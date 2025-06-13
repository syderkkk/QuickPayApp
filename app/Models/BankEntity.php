<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankEntity extends Model
{
    protected $table = 'bank_entities';

    protected $fillable = [
        'nombre',
        'codigo',
    ];
}
