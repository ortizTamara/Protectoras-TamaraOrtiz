<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOpcionConsultaRequest;
use App\Http\Requests\UpdateOpcionConsultaRequest;
use App\Models\OpcionConsulta;

class OpcionConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.opcionConsulta.index', ['opcionConsulta' => OpcionConsulta::paginate(8)]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.opcionConsulta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpcionConsultaRequest $request)
    {
        $validated = $request->validated();

        $opcionConsulta = OpcionConsulta::create($validated);

        return redirect()->route('opcionConsulta.index')->with('success', "$opcionConsulta->nombre has sido creado exitosamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(OpcionConsulta $opcionConsulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpcionConsulta $opcionConsulta)
    {
        return view('administrador.opcionConsulta.edit', compact('opcionConsulta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpcionConsultaRequest $request, OpcionConsulta $opcionConsulta)
    {
        $validated = $request->validated();

        $opcionConsulta->update($validated);

        return redirect()->route('opcionConsulta.index')->with('success', "$opcionConsulta->nombre has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpcionConsulta $opcionConsulta)
    {
        $opcionConsulta->delete();


        return redirect()->route('color.index')->with('success', 'Registro eliminado exitosamente');
    }
}
