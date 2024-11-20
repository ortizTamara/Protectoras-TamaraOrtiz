<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiProtectoraController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener la protectora asociada al usuario autenticado
        $miProtectora = Protectora::find($user->protectora_id);

        if (!$miProtectora) {
            return redirect()->route('perfil')->with('error', 'No tienes una protectora asociada.');
        }

        // Pasar los datos a la vista
        return view('perfil.protectoras.index', compact('miProtectora'));
    }
}
