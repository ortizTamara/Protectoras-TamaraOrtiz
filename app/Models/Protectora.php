<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protectora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais_id',
        'provincia_id',
        'comunidad_autonoma',
        'codigo_postal',
        'direccion',
        'numero_telefono',
        'email',
        'instagram',
        'twitter',
        'facebook',
        'web',
    ];
}
