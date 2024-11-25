<?php

namespace Database\Seeders;

use App\Models\EstadoAnimal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoAnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            'En Adopción',
            'Urgente',
            'En acogida',
        ];

        foreach ($estados as $estadoAnimal) {
            EstadoAnimal::create([
                'nombre' => $estadoAnimal,
            ]);
        }
    }
}
