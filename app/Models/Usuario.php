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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($usuario) {
            if (is_null($usuario->rol_id)) {
                $usuario->rol_id = 2; // 2 es el ID del ROL de USUARIO
            }
        });
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class)->withDefault();
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class);
    }

    public function comunidadAutonoma(): BelongsTo
    {
        return $this->belongsTo(ComunidadAutonoma::class);
    }

    public function provincia(): BelongsTo
    {
    return $this->belongsTo(Provincia::class);
    }

    public function protectora(): BelongsTo
    {
        return $this->belongsTo(Protectora::class)->withDefault();
    }

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
