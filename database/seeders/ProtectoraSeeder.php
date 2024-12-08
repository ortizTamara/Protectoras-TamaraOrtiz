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
                'logo' => null,
                'esValido' => true,
                'motivo_rechazo' => null,
            ],
        ];

        foreach ($protectoras as $protectora) {
            Protectora::firstOrCreate(
                ['numero_registro_oficial' => $protectora['numero_registro_oficial']], // Verificación para evitar duplicados
                $protectora
            );
        }
    }
}
