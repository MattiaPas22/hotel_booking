<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // ATTRIBUTI ASSEGNABILI IN MASSA
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'beds',
        'available_from', 
        'available_to',   
    ];

    // ATTRIBUTI CONVERTITI A TIPI NATIVI
    protected $casts = [
        'available_from' => 'datetime',
        'available_to' => 'datetime',
        'price_per_night' => 'float',
    ];
}
