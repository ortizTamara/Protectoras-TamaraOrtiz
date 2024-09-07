<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colores = [
            'Negro',
            'Blanco',
            'Gris',
            'Naranja',
            'Crema',
            'Chocolate',
            'Canela',
            'Bicolor',
            'Tricolor',
            'Carey ',
            'Atigrado',
            'Rubio',
        ];

        foreach ($colores as $color) {
            Color::create([
                'nombre' => $color,
            ]);
        }
    }
}
