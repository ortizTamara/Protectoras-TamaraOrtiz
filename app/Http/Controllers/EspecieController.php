<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Http\Requests\StoreEspecieRequest;
use App\Http\Requests\UpdateEspecieRequest;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.especies.index', ['especies' => Especie::paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.especies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEspecieRequest $request)
    {
        $validated = $request->validated();

        $especie = Especie::create($validated);

        return redirect()->route('especie.index')->with('success', "$especie->nombre has sido creado exitosamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Especie $especie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especie $especie)
    {
        return view('administrador.especies.edit', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEspecieRequest $request, Especie $especie)
    {
        $validated = $request->validated();

        $especie->update($validated);

        return redirect()->route('especie.index')->with('success', "$especie->name has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especie $especie)
    {

        $especie->delete();


        return redirect()->route('especie.index')->with('success', 'Registro eliminado exitosamente');
    }
}
