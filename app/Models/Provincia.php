<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'comunidad_autonoma_id',
    ];

    public function comunidadAutonoma(): BelongsTo
    {
        return $this->belongsTo(ComunidadAutonoma::class);
    }
}
