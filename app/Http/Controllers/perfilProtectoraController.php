<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class perfilProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Verificar si el usuario es admin o tiene protectora_id asignado
        if ($user->protectora_id || $user->rol_id == 1) {
            $protectora = Protectora::find($user->protectora_id);

            // Pasar la variable $protectora a la vista (puede ser null si no hay datos)
            return view('perfil.perfilProtectora.index', compact('protectora'));
        }

        // Redirigir a la página de perfil con un mensaje de error si no tiene permisos
        return redirect()->route('perfil')->with('error', 'No tienes acceso a esta sección.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
