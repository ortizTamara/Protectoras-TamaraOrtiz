<?php

namespace Database\Seeders;

use App\Models\NivelActividad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nivelActividades = [
            'Nula',
            'Baja',
            'Media',
            'Alta',
            'Muy Alta',

        ];

        foreach ($nivelActividades as $nivelActividad) {
            NivelActividad::create([
                'nombre' => $nivelActividad,
            ]);
        }
    }
}
