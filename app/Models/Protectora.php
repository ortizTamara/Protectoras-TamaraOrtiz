<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Protectora extends Model
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
    ];

    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class);

        // También se puede hacer asi, que serviria para asegurarnos que es a ese campo, ya que el laravel asume por defecto la clave
        // return $this->hasOne(Usuario::class, 'protectora_id');
    }

    public function animales(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

}
