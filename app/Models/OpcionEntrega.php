<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OpcionEntrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function animals(): BelongsToMany
{
    return $this->belongsToMany(Animal::class);
}
}
