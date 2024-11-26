<?php

namespace Database\Seeders;

use App\Models\GeneroAnimal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroAnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            'Hembra',
            'Macho',
        ];

        foreach ($generos as $genero) {
            GeneroAnimal::create([
                'nombre' => $genero,
            ]);
        }
    }
}
