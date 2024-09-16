<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComunidadAutonoma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais_id',
    ];


    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }
}
