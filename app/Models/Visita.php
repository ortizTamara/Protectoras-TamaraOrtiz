<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'usuario_id',
        'mensaje',
    ];

    public function mascota()
    {
        return $this->belongsTo(Animal::class);
    }


    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
