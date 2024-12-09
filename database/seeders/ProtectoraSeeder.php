<?php

namespace Database\Seeders;

use App\Models\Protectora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProtectoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $protectoras = [
            [
                'nombre' => 'Refugio Felino',
                'numero_registro_oficial' => '123456',
                'capacidad_alojamiento' => 100,
                'nuestra_historia' => 'Esta protectora se fundó con el objetivo de cuidar y proteger a los animales.',
                'direccion' => 'Calle de los Animales, 123',
                'telefono_contacto' => '687654321',
                'instagram' => 'https://instagram.com/protectoraejemplo',
                'twitter' => 'https://twitter.com/protectoraejemplo',
                'facebook' => 'https://facebook.com/protectoraejemplo',
                'web' => 'https://www.protectoraejemplo.com',
                'logo' => 'logos/protectora_6_2024-11-27_20-17-14.png',
                'esValido' => true,
                'motivo_rechazo' => null,
            ],
            [
                'nombre' => 'La Bienvenida',
                'numero_registro_oficial' => '5151848',
                'capacidad_alojamiento' => 50,
                'nuestra_historia' => 'Esta protectora se fundó con el objetivo de cuidar y proteger a los animales.',
                'direccion' => 'Calle de los Animales, 123',
                'telefono_contacto' => '687654321',
                'instagram' => 'https://instagram.com/protectoraejemplo',
                'twitter' => 'https://twitter.com/protectoraejemplo',
                'facebook' => 'https://facebook.com/protectoraejemplo',
                'web' => 'https://www.protectoraejemplo.com',
                'logo' => 'logos/protectora_1_2024-11-26_13-01-03.png',
                'esValido' => true,
                'motivo_rechazo' => null,
            ],
        ];

        foreach ($protectoras as $protectora) {
            Protectora::firstOrCreate(
                ['numero_registro_oficial' => $protectora['numero_registro_oficial']],
                $protectora
            );
        }
    }
}
