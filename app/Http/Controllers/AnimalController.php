<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Comportamiento;
use App\Models\Especie;
use App\Models\EstadoAnimal;
use App\Models\OpcionEntrega;
use App\Models\Raza;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($protectora_id)
    {
        $especies = Especie::all();
        $razas = Raza::all();
        $comportamientos = Comportamiento::all();
        $sexos = ['Macho', 'Hembra'];
        $nivelesActividad = ['Bajo', 'Medio', 'Alto'];
        $estados = EstadoAnimal::all();
        $opcionesEntrega = OpcionEntrega::all();

        return view('perfil.protectoras.animales.create', compact(
            'especies', 'razas', 'comportamientos', 'sexos', 'nivelesActividad', 'estados', 'protectora_id', 'opcionesEntrega'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric|min:0',
            'estado_id' => 'required|exists:estado_animals,id',
            'especie_id' => 'required|exists:especies,id',
            'raza_id' => 'nullable|exists:razas,id',
            'sexo' => 'required|string|in:Macho,Hembra',
            'nivel_actividad' => 'nullable|string|in:Bajo,Medio,Alto',
            'comportamientos' => 'nullable|array',
            'comportamientos.*' => 'exists:comportamientos,id',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $animal = Animal::create($validated);

        // Relación con comportamientos
        if ($request->has('comportamientos')) {
            $animal->comportamientos()->sync($request->comportamientos);
        }

        return redirect()->route('perfil.protectoras.show')->with('success', 'Animal creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
