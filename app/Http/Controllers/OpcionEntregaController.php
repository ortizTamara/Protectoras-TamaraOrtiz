<?php

namespace App\Http\Controllers;

use App\Models\OpcionEntrega;
use App\Http\Requests\StoreOpcionEntregaRequest;
use App\Http\Requests\UpdateOpcionEntregaRequest;

class OpcionEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.entregas.index', ['entregas' => OpcionEntrega::paginate(8)]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.entregas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpcionEntregaRequest $request)
    {
        $validated = $request->validated();

        $opcionEntrega = OpcionEntrega::create($validated);

        return redirect()->route('opcionEntrega.index')->with('success', "$opcionEntrega->nombre ha sido creado exitosamente.");

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
    public function edit(OpcionEntrega $opcionEntrega)
    {
        return view('administrador.entregas.edit', compact('opcionEntrega'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpcionEntregaRequest $request, OpcionEntrega $opcionEntrega)
    {
        $validated = $request->validated();

        $opcionEntrega->update($validated);

        return redirect()->route('opcionEntrega.index')->with('success', "$opcionEntrega->nombre has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpcionEntrega $opcionEntrega)
    {
        $opcionEntrega->delete();

        return redirect()->route('opcionEntrega.index')->with('success', 'Registro eliminado exitosamente');

    }
}
