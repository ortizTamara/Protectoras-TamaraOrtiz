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
        'esValido',
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

    protected $attributes = [
        'esValido' => false, // Establece false como valor predeterminado
    ];

    // Se elimina los animales asociados, el usuario no se elimina -> protectora_id = null
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($protectora) {
            // Eliminamos animales asociados
            if ($protectora->animales()->exists()) {
                $protectora->animales()->delete();
            }

            // Desvinculamos usuario asociado (no eliminar)
            if ($protectora->usuario()->exists()) {
                $protectora->usuario->update(['protectora_id' => null]);
            }
        });
    }

    /*
    // Eliimnamos los animales asociados y el usuario
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($protectora) {
            // Eleminamos animales asociados
            if ($protectora->animales()->exists()) {
                $protectora->animales()->delete();
            }

            // Eleminamos usuario asociado
            if ($protectora->usuario()->exists()) {
                $protectora->usuario()->delete();
            }
        });
    }
    */

}
