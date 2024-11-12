<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ColorSeeder::class,
            EspecieSeeder::class,
            RazaSeeder::class,
            PaisSeeder::class,
            ComunidadAutonomaSeeder::class,
            ProvinciaSeeder::class,
            GeneroSeeder::class,
            RolSeeder::class,
            UsuarioSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
