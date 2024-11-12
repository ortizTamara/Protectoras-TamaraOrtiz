<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class);
    }
}
