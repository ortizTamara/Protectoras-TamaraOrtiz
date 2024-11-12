<?php

namespace Database\Seeders;

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
        $usuarios = [
            [
                'nombre' => 'Administrador',
                'apellidos' => 'Principal',
                'fecha_nacimiento' => '2000-10-16',
                'genero_id' => 1,
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'numero_telefono' => '123456789',
                'pais_id' => 1,
                'comunidad_autonoma_id' => 8,
                'codigo_postal' => '13670',
                'rol_id' => 1,
                'protectora_id' => null,
            ]
        ];

        foreach ($usuarios as $usuario) {
            Usuario::firstOrCreate(
                ['email' => $usuario['email']], // Verificación para evitar duplicados
                $usuario
            );
        }
    }
}
