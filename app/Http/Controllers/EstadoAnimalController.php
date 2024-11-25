<?php

namespace App\Http\Controllers;

use App\Models\EstadoAnimal;
use App\Http\Requests\StoreEstadoAnimalRequest;
use App\Http\Requests\UpdateEstadoAnimalRequest;

class EstadoAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.estados.index', ['estados' => EstadoAnimal::paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('administrador.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoAnimalRequest $request)
    {
        $validated = $request->validated();

        $estadoAnimal = EstadoAnimal::create($validated);

        return redirect()->route('estadoAnimal.index')->with('success', "$estadoAnimal->nombre ha sido creado exitosamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoAnimal $estadoAnimal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoAnimal $estadoAnimal)
    {
        return view('administrador.estados.edit', compact('estadoAnimal'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadoAnimalRequest $request, EstadoAnimal $estadoAnimal)
    {
        $validated = $request->validated();

        $estadoAnimal->update($validated);

        return redirect()->route('estadoAnimal.index')->with('success', "$estadoAnimal->nombre has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoAnimal $estadoAnimal)
    {
        $estadoAnimal->delete();

        return redirect()->route('estadoAnimal.index')->with('success', 'Registro eliminado exitosamente');

    }
}
