<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'mensaje',
        'esLeido',
        'opcion_consultas_id',
    ];

    protected $attributes = [
        'esLeido' => false,
    ];

    public function opcionConsulta():BelongsTo
    {
        return $this->belongsTo(OpcionConsulta::class, 'opcion_consultas_id');
    }
}
