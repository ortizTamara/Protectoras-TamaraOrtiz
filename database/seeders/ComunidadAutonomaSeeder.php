<?php

namespace Database\Seeders;

use App\Models\ComunidadAutonoma;
use App\Models\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComunidadAutonomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comunidadesAutonomas = [
            [
                'pais' => 'España',
                'comunidadesAutonomas' => [
                    'Andalucía',
                    'Cataluña',
                    'Comunidad de Madrid',
                    'Comunidad Valenciana',
                    'Galicia',
                    'País Vasco',
                    'Castilla y León',
                    'Castilla-La Mancha',
                    'Canarias',
                    'Aragón',
                    'Extremadura',
                    'Asturias',
                    'Cantabria',
                    'Islas Baleares',
                    'La Rioja',
                    'Murcia',
                    'Navarra',
                    'Ceuta',
                    'Melilla'
                ]
            ]
        ];

        foreach ($comunidadesAutonomas as $comunidadAutonoma) {
            $pais = Pais::where('nombre', $comunidadAutonoma['pais'])->first();

            foreach ($comunidadAutonoma['comunidadesAutonomas'] as $nombreComunidad) {
                ComunidadAutonoma::create([
                    'nombre' => $nombreComunidad,
                    'pais_id' => $pais->id,
                ]);
            }
        }
    }
}
