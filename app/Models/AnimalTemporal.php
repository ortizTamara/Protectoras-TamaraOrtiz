<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AnimalTemporal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_nacimiento',
        'peso',
        'imagen',
        'genero_animal_id',
        'nivel_actividad_id',
        'color_id',
        'especie_id',
        'raza_id',
        'estado_animal_id',
        'protectora_id',
        'marcado_para_eliminar',

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

    public function comportamientos(): BelongsToMany
    {
        return $this->belongsToMany(Comportamiento::class, 'animal_temporal_comportamientos');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(EstadoAnimal::class);
    }

    public function opcionesEntrega(): BelongsToMany
    {
        return $this->belongsToMany(OpcionEntrega::class, 'animal_temporal_opcion_entregas');
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(GeneroAnimal::class);
    }

    public function nivelActividad(): BelongsTo
    {
        return $this->belongsTo(NivelActividad::class);
    }

    public function protectora(): BelongsTo
    {
        return $this->belongsTo(Protectora::class);
    }
}
