<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'genero_id',
        'email',
        'password',
        'numero_telefono',
        'pais_id',
        'comunidad_autonoma_id',
        'provincia_id',
        'codigo_postal',
        'rol_id',
        'protectora_id',
        'foto',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;

    }

    // Asigna el rol por defecto al usuario
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($usuario) {
            if (is_null($usuario->rol_id)) {
                $usuario->rol_id = 2; // 2 es el ID del ROL de USUARIO
            }
        });
    }

    // Relación con el modelo ROL
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class)->withDefault();
    }

    // Relación con el modelo GENERO
    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    // Relación con el modelo PAIS
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class);
    }

    // Relación con el modelo COMUNIDAD AUTONOMA
    public function comunidadAutonoma(): BelongsTo
    {
        return $this->belongsTo(ComunidadAutonoma::class);
    }

    // Relacion con el modelo PROVINCIA
    public function provincia(): BelongsTo
    {
    return $this->belongsTo(Provincia::class);
    }

    // Relación con el modelo Protectora
    public function protectora(): BelongsTo
    {
        return $this->belongsTo(Protectora::class)->withDefault();
    }

    // Verifica si el usuario tiene un rol específico
    public function hasRole($roleName)
    {
        return optional($this->rol)->nombre === $roleName;
    }

    public function hasRoleId($roleId)
    {
        return $this->rol_id == $roleId;
    }

    public function permisos(): BelongsToMany
    {
        return $this->belongsToMany(Permiso::class, 'permiso_roles');
    }

    public function favoritos()
    {
        return $this->belongsToMany(Animal::class, 'usuario_animal_favoritos', 'usuario_id', 'animal_id')
                    ->withTimestamps();
    }
}
