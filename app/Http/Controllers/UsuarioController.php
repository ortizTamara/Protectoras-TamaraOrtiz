<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carga los usuarios con las relaciones rol y protectora
        $usuarios = Usuario::with('rol', 'protectora')->get();

        // Retorna la vista con los usuarios
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Nuevo Usuario";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
    // Cargar las relaciones 'rol' y 'protectora' en el objeto $usuario
    $usuario->load('rol', 'protectora');

    return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function showProfile(Usuario $usuario)
    {
        $usuario = auth()->$usuario(); // Obtiene al usuario autenticado

        // Retorna la vista con los datos del usuario
        return view('usuarios.profile', compact('usuario'));
    }
}
