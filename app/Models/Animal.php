<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    /**
     * Añadimos los campos que puedan ser rellenados por asignación masiva (método Animal::create)
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_nacimiento',
        'peso',
        'image',
        'color_id',
        'especie_id',
        'raza_id',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }

    public function raza(): BelongsTo
    {
        return $this->belongsTo(Raza::class);
    }
}
