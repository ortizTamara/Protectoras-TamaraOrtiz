<?php

namespace Database\Seeders;

use App\Models\Comportamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComportamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comportamientos = [
            [
                'nombre' => [
                    'Bueno con extraños',
                    'Bueno con niños',
                    'Tímido',
                    'Cariñoso',
                    'Le gusta estar en compañía',
                    'Juguetón',
                    'Independiente',
                ],
                'categoria' => 'Social',
            ],
            [
                'nombre' => [
                    'Bueno en casa',
                    'Bueno en el coche',
                    'Escapista',
                    'Tranquilo en ambientes ruidosos',
                    'Adaptable a nuevos entornos',
                    'Activo al aire libre',
                    'Protector de su territorio',
                ],
                'categoria' => 'Ambiente',
            ],
            [
                'nombre' => [
                    'Bueno con adultos mayores',
                    'Obediente',
                    'Le gusta pasear',
                    'Requiere atención constante',
                    'Buen temperamento',
                    'Cariñoso con su dueño',
                    'Tolerante al manejo físico',
                ],
                'categoria' => 'Relación con Humanos',
            ],
            [
                'nombre' => [
                    'Bueno con perros',
                    'Bueno con gatos',
                    'Bueno con otros animales',
                    'Juega con otros animales',
                    'Dominante',
                    'Sumiso',
                    'Tolerante en manadas',
                    'Protector de otros animales',
                ],
                'categoria' => 'Relación con Animales',
            ],
        ];

        foreach ($comportamientos as $grupo) {
            foreach ($grupo['nombre'] as $nombre) {
                Comportamiento::create([
                    'nombre' => $nombre,
                    'categoria' => $grupo['categoria'],
                ]);
            }
        }
    }
}
