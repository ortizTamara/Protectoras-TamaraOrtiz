<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioAnimalFavoritoController extends Controller
{
    public function index()
    {
        $favoritos = Auth::user()->favoritos;
        return view('perfil.favoritos.index', compact('favoritos'));
    }

    public function store($animalId)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Debes iniciar sesión para añadir favoritos.'], 401);
        }

        $user = Auth::user();

        try {
            $animal = Animal::findOrFail($animalId);

            $user->favoritos()->syncWithoutDetaching($animal->id);

            return response()->json(['message' => 'Animal añadido a favoritos.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al añadir el animal a favoritos.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($animalId)
    {
        try {
            Auth::user()->favoritos()->detach($animalId);
            return response()->json(['message' => 'Animal eliminado de favoritos'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el animal de favoritos', 'error' => $e->getMessage()], 500);
        }
    }
}
