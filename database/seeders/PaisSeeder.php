<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            'España',
        ];

        foreach ($paises as $pais) {
            Pais::create([
                'nombre' => $pais,
            ]);
        }
    }
}
