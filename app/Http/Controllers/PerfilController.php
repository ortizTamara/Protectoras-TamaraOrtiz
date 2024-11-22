<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('perfil.index');
    }




    public function changePassword(Request $request)
    {
        // Validar los datos
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar la contraseña usando DB::table
        DB::table('users')
            ->where('id', Auth::id()) // Obtener el ID del usuario autenticado
            ->update(['password' => Hash::make($request->new_password)]);

        // Redirigir con un mensaje de éxito
        return back()->with('success', 'La contraseña se ha cambiado correctamente.');
    }

}
