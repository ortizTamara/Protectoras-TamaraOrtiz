<?php

namespace Database\Seeders;

use App\Models\OpcionEntrega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpcionEntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Desparasitado',
            'Esterelizado',
            'Vacunado',
            'Microchip',
            'Con cartilla sanitaria',
        ];

        foreach ($opciones as $opcion) {
            OpcionEntrega::create([
                'nombre' => $opcion,
            ]);
        }
    }
}
