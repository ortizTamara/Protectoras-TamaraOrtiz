<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comportamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria',
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
