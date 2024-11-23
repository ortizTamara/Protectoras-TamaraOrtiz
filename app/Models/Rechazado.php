<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rechazado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'numero_registro_oficial',
        'capacidad_alojamiento',
        'nuestra_historia',
        'direccion',
        'telefono_contacto',
        'instagram',
        'twitter',
        'facebook',
        'web',
        'logo',
        'esValido',
        'motivo_rechazo',
    ];

}
