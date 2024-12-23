<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpcionConsulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function consultas():HasMany
    {
        return $this->hasMany(Consulta::class, 'opcion_consultas_id');
    }
}
