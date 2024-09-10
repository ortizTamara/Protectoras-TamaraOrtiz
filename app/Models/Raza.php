<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especie_id',
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    // Relación de tipo belongsTo. Raza pertenece a un único registro del modelo Especie.
    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }
}
