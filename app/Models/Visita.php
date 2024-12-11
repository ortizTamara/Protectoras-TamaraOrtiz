<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'protectora_id',
        'animal_id',
        'mensaje',
        'estado',
    ];

   public function usuario()
   {
       return $this->belongsTo(Usuario::class);
   }

   public function animal()
   {
       return $this->belongsTo(Animal::class);
   }

   public function protectora()
   {
       return $this->belongsTo(Protectora::class);
   }
}
