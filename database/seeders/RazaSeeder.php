<?php

namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Raza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $razas = [
            [
                'especie' => 'Gato',
                'razas' => [ 'Europeo',
                'Siamés',
                'Persa',
                'Maine Coon',
                'Ragdoll',
                'British Shorthair',
                'Sphynx ',
                'Bombay',
                'Manx',
                'Russian Blue ']
            ],
            ['especie' => 'Perro',
            'razas' => [
                'Pitbull Terrier',
                'Labrador Retriever',
                'Pastor Alemán',
                'Chihuahua',
                'Beagle',
                'Boxer',
                'Cocker Spaniel',
                'Bulldog ',
                'Husky Siberiano']
            ],
        ];


        foreach ($razas as $raza) {
            $especie = Especie::where('nombre', $raza['especie'])->first();

            foreach ($raza['razas'] as $nombreRaza) {
                Raza::create([
                    'nombre' => $nombreRaza,
                    'especie_id' => $especie->id,
                ]);
            }
        }
    }
}
