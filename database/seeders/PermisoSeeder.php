<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creación de permisos para Protectora y Usuario
        $permisosProtectora = [
            'añadir animales',
            'gestionar animales',
        ];

        $permisosUsuario = [
            'ver animales',
        ];

        // Creamos permisos para Protectora y Usuario en la base de datos
        foreach (array_merge($permisosProtectora, $permisosUsuario) as $permisoNombre) {
            Permiso::firstOrCreate(['nombre' => $permisoNombre]);
        }

        //Asignación de todos los permisos al rol Administrador
        $adminRol = Rol::where('nombre', 'Administrador')->first();
        $allPermisos = Permiso::all();
        $adminRol->permisos()->sync($allPermisos->pluck('id'));


        // Asignamos permisos espécificos al rol Usuario
        $usuarioRol = Rol::where('nombre', 'Usuario')->first();
        $usuarioPermisos = Permiso::whereIn('nombre', $permisosUsuario)->get();
        $usuarioRol->permisos()->sync($usuarioPermisos->pluck('id'));

        // Asignamos permisos espécificos al rol Protectora
        $protectoraRol = Rol::where('nombre', 'Protectora')->first();
        $protectoraPermisos = Permiso::whereIn('nombre', $permisosProtectora)->get();
        $protectoraRol->permisos()->sync($protectoraPermisos->pluck('id'));

    }
}
