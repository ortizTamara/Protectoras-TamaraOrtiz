<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory, Notifiable;

 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'genero_id',
        'email',
        'password',
        'telefono',
        'pais_id',
        'comunidad_autonoma_id',
        'provincia_id',
        'codigo_postal',
        'rol_id',
        'protectora_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con el modelo ROL, de tipo belongsTo, ya que el Rol pertenece a un único registro del modelo Usuario
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
