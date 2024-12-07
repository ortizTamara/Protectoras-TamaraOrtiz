<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\UsuarioAnimalFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MiFavoritoController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Obtener los favoritos del usuario con datos del animal
        $favoritos = UsuarioAnimalFavorito::with('animal.especie', 'animal.raza', 'animal.color')
            ->where('usuario_id', $usuario->id)
            ->get();

        return view('favoritos.index', compact('favoritos'));
    }

    public function store(Request $request)
    {

    }


    public function destroy(Request $request)
    {

    }
}
