<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use App\Http\Requests\StoreRazaRequest;
use App\Http\Requests\UpdateRazaRequest;
use App\Models\Especie;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.razas.index', ['razas' => Raza::paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.razas.create', ['especies' => Especie::all(['id', 'nombre'])]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRazaRequest $request)
    {
        $validated = $request->validated();

        $raza = Raza::create($validated);

        return redirect()->route('raza.index')->with('success', "$raza->nombre has sido creado exitosamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Raza $raza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raza $raza)
    {
        return view('administrador.razas.edit', compact('raza'), ['especies' => Especie::all(['id', 'nombre'])]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRazaRequest $request, Raza $raza)
    {
        $validated = $request->validated();

        $raza->update($validated);

        return redirect()->route('raza.index')->with('success', "$raza->name has sido actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raza $raza)
    {
        $raza->delete();


        return redirect()->route('raza.index')->with('success', 'Registro eliminado exitosamente');
    }

    public function getRazas($especieId = null)
    {
        if ($especieId) {
            $razas = Raza::where('especie_id', $especieId)->get();
        } else {
            $razas = Raza::all();
        }

        return response()->json($razas);
    }

    // public function getRazasPorEspecie($especieId)
    // {
    //     $razas = Raza::where('especie_id', $especieId)->get();

    //     return response()->json($razas);
    // }
}
