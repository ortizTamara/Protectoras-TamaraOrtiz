<?php

namespace App\Http\Controllers;

use App\Models\Comportamiento;
use App\Http\Requests\StoreComportamientoRequest;
use App\Http\Requests\UpdateComportamientoRequest;

class ComportamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.comportamientos.index', ['comportamientos' => Comportamiento::paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.comportamientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComportamientoRequest $request)
    {
        $validated = $request->validated();

        $comportamiento = Comportamiento::create($validated);

        return redirect()->route('comportamiento.index')->with('success', "$comportamiento->nombre has sido creado exitosamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comportamiento $comportamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comportamiento $comportamiento)
    {
        return view('administrador.comportamientos.edit', compact('comportamiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComportamientoRequest $request, Comportamiento $comportamiento)
    {
        $validated = $request->validated();

        $comportamiento->update($validated);

        return redirect()->route('comportamiento.index')->with('success', "$comportamiento->name has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comportamiento $comportamiento)
    {
        $comportamiento->delete();


        return redirect()->route('comportamiento.index')->with('success', 'Registro eliminado exitosamente');
    }
}
