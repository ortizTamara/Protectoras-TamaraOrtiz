<?php

namespace Database\Seeders;

use App\Models\OpcionConsulta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpcionConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Protectoras en tu zona',
            'Adopción de animales',
            'Consultas sobre cuidados y salud',
            'Voluntariado',
            'Problemas con el sitio web',
            'Error en la información',
        ];

        foreach ($opciones as $opcion) {
            OpcionConsulta::create([
                'nombre' => $opcion,
            ]);
        }
    }
}
