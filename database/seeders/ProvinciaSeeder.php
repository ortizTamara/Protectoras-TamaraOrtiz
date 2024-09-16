<?php

namespace Database\Seeders;

use App\Models\ComunidadAutonoma;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            [
                'comunidad' => 'Andalucía',
                'provincias' => [
                    'Almería',
                    'Cádiz',
                    'Córdoba',
                    'Granada',
                    'Huelva',
                    'Jaén',
                    'Málaga',
                    'Sevilla',
                ]
            ],
            [
                'comunidad' => 'Cataluña',
                'provincias' => [
                    'Barcelona',
                    'Girona',
                    'Lleida',
                    'Tarragona',
                ]
            ],
            [
                'comunidad' => 'Comunidad de Madrid',
                'provincias' => [
                    'Madrid',
                ]
            ],
            [
                'comunidad' => 'Comunidad Valenciana',
                'provincias' => [
                    'Alicante',
                    'Castellón',
                    'Valencia',
                ]
            ],
            [
                'comunidad' => 'Galicia',
                'provincias' => [
                    'A Coruña',
                    'Lugo',
                    'Ourense',
                    'Pontevedra',
                ]
            ],
            [
                'comunidad' => 'País Vasco',
                'provincias' => [
                    'Álava',
                    'Guipúzcoa',
                    'Vizcaya',
                ]
            ],
            [
                'comunidad' => 'Castilla y León',
                'provincias' => [
                    'Ávila',
                    'Burgos',
                    'León',
                    'Palencia',
                    'Salamanca',
                    'Segovia',
                    'Soria',
                    'Valladolid',
                    'Zamora',
                ]
            ],
            [
                'comunidad' => 'Castilla-La Mancha',
                'provincias' => [
                    'Albacete',
                    'Ciudad Real',
                    'Cuenca',
                    'Guadalajara',
                    'Toledo',
                ]
            ],
            [
                'comunidad' => 'Canarias',
                'provincias' => [
                    'Las Palmas',
                    'Santa Cruz de Tenerife',
                ]
            ],
            [
                'comunidad' => 'Aragón',
                'provincias' => [
                    'Huesca',
                    'Teruel',
                    'Zaragoza',
                ]
            ],
            [
                'comunidad' => 'Extremadura',
                'provincias' => [
                    'Badajoz',
                    'Cáceres',
                ]
            ],
            [
                'comunidad' => 'Asturias',
                'provincias' => [
                    'Asturias',
                ]
            ],
            [
                'comunidad' => 'Cantabria',
                'provincias' => [
                    'Cantabria',
                ]
            ],
            [
                'comunidad' => 'Islas Baleares',
                'provincias' => [
                    'Islas Baleares',
                ]
            ],
            [
                'comunidad' => 'La Rioja',
                'provincias' => [
                    'La Rioja',
                ]
            ],
            [
                'comunidad' => 'Murcia',
                'provincias' => [
                    'Murcia',
                ]
            ],
            [
                'comunidad' => 'Navarra',
                'provincias' => [
                    'Navarra',
                ]
            ],
            [
                'comunidad' => 'Ceuta',
                'provincias' => [
                    'Ceuta',
                ]
            ],
            [
                'comunidad' => 'Melilla',
                'provincias' => [
                    'Melilla',
                ]
            ],
        ];

        foreach ($provincias as $provincia) {
            $comunidadAutonoma = ComunidadAutonoma::where('nombre', $provincia['comunidad'])->first();

            foreach ($provincia['provincias'] as $nombreProvincia) {
                Provincia::create([
                    'nombre' => $nombreProvincia,
                    'comunidad_autonoma_id' => $comunidadAutonoma->id,
                ]);
            }
        }
    }
}
