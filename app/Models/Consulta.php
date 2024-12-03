<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function opcionConsulta()
    {
        return $this->belongsTo(OpcionConsulta::class, 'opcion_consultas_id');
    }
}
