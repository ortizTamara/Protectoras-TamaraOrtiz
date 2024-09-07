<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especies = [
            'Gato',
            'Perro',
        ];

        foreach($especies as $especie)
        {
            Especie::create([
                'nombre' => $especie
            ]);
        }
    }
}
