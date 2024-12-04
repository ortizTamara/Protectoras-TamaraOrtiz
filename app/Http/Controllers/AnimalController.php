<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Color;
use App\Models\Comportamiento;
use App\Models\Especie;
use App\Models\EstadoAnimal;
use App\Models\GeneroAnimal;
use App\Models\NivelActividad;
use App\Models\OpcionEntrega;
use App\Models\Protectora;
use App\Models\Raza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $generos = GeneroAnimal::all();
        $nivelesActividad = NivelActividad::all();
        $estados = EstadoAnimal::all();
        $opcionesEntrega = OpcionEntrega::all();
        $colores = Color::all();

        return view('perfil.protectoras.animales.create', compact(
            'especies', 'razas', 'comportamientos', 'nivelesActividad', 'estados', 'protectora_id', 'opcionesEntrega', 'colores', 'generos'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $usuario = Auth::user();
        $protectora = Protectora::find($usuario->protectora_id);

        if (!$protectora) {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'peso' => 'required|numeric|min:0.1',
            'estado_animal_id' => 'required|exists:estado_animals,id',
            'especie_id' => 'required|exists:especies,id',
            'raza_id' => 'required|exists:razas,id',
            'color_id' => 'required|exists:colors,id',
            'genero_animal_id' => 'required|exists:genero_animals,id',
            'nivel_actividad_id' => 'required|exists:nivel_actividads,id',
            'comportamientos' => 'required|array|min:1|exists:comportamientos,id',
            'opciones_entrega' => 'required|array|min:1|exists:opcion_entregas,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'nullable|string|max:5000',
        ]);

        if ($request->hasFile('imagen')) {
            $fileName = 'animal_' . $protectora->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('imagen')->getClientOriginalExtension();

            $path = $request->file('imagen')->storeAs('animales', $fileName, 'public');
            $validatedData['imagen'] = $path;
        }

        $validatedData['protectora_id'] = $protectora->id;

        $animal = Animal::create($validatedData);

        if (!empty($validatedData['comportamientos'])) {
            $animal->comportamientos()->sync($validatedData['comportamientos']);
        }

        if (!empty($validatedData['opciones_entrega'])) {
            $animal->opcionesEntrega()->sync($validatedData['opciones_entrega']);
        }

    return redirect()->route('perfil-miProtectora.edit', $protectora->id)
                     ->with('success', 'Protectora actualizada correctamente.');
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
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $usuario = Auth::user();

        if ($usuario->protectora_id != $animal->protectora_id) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este animal.');
        }

        $animal->update(['marcado_para_eliminar' => true]);

        return redirect()->back()->with('info', 'El animal ha sido marcado para eliminar. Debes guardar los cambios para confirmar la eliminación.');
    }
    // public function destroy(Animal $animal)
    // {
    //     $usuario = Auth::user();

    //     // Verificar permisos
    //     if ($usuario->rol_id != 1 && $usuario->protectora_id != $animal->protectora_id) {
    //         return redirect()->back()->with('error', 'No tienes permisos para eliminar este animal.');
    //     }

    //     // Eliminar animal
    //     $animal->delete();

    //     return redirect()->back()->with('success', 'Animal eliminado correctamente.');
    // }
}
