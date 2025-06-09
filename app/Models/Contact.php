<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',        // El dueño de la lista de contactos
        'contact_id',     // El usuario que es el contacto
        'alias',          // Alias del contacto (opcional)
        'times_used',     // Veces que ha sido usado (para frecuentes)
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }
}
