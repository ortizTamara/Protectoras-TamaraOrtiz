<?php

namespace Database\Seeders;

use App\Models\Protectora;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      // Buscar la protectora creada en su Seeder
      $protectora = Protectora::where('nombre', 'Refugio Felino')->first();
      $protectora2 = Protectora::where('nombre', 'La Bienvenida')->first();

      if (!$protectora) {
          throw new \Exception("Las protectoras no existen. Asegúrate de correr el ProtectoraSeeder antes de este seeder.");
      }

        $usuarios = [
            [
                'nombre' => 'Administrador',
                'apellidos' => 'Principal',
                'fecha_nacimiento' => '2000-10-16',
                'genero_id' => 2,
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'numero_telefono' => '123456789',
                'pais_id' => 1,
                'comunidad_autonoma_id' => 8,
                'provincia_id' => 34,
                'codigo_postal' => '13670',
                'rol_id' => 1,
                'protectora_id' => null,
                'foto' => null,
            ],
            [
                'nombre' => 'Tamara',
                'apellidos' => 'Ortiz Gómez',
                'fecha_nacimiento' => '2000-10-16',
                'genero_id' => 1,
                'email' => 'tamaraortiz403@gmail.com',
                'password' => Hash::make('user123'),
                'numero_telefono' => '687654321',
                'pais_id' => 1,
                'comunidad_autonoma_id' => 8,
                'provincia_id' => 34,
                'codigo_postal' => '13670',
                'rol_id' => 2,
                'protectora_id' => $protectora->id,
                'foto' => 'fotos/2_2024-11-26_13-00-54.jpg',
            ],
            [
                'nombre' => 'Miguel',
                'apellidos' => 'Diaz Villanueva',
                'fecha_nacimiento' => '2002-08-12',
                'genero_id' => 2,
                'email' => 'migueldiaz@gmail.com',
                'password' => Hash::make('user123'),
                'numero_telefono' => '612345678',
                'pais_id' => 1,
                'comunidad_autonoma_id' => 8,
                'provincia_id' => 34,
                'codigo_postal' => '13670',
                'rol_id' => 2,
                'protectora_id' => $protectora2->id,
                'foto' => 'fotos/3_2024-11-27_20-09-51.jpg',
            ],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::firstOrCreate(
                ['email' => $usuario['email']], // Verificación para evitar duplicados
                $usuario
            );
        }
    }
}
