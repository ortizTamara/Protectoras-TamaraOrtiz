<?php

namespace App\Http\Controllers;

use App\Models\AnimalTemporal;
use App\Models\Color;
use App\Models\Comportamiento;
use App\Models\Especie;
use App\Models\EstadoAnimal;
use App\Models\GeneroAnimal;
use App\Models\NivelActividad;
use App\Models\OpcionEntrega;
use App\Models\Protectora;
use App\Models\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalTemporalController extends Controller
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
    public function create()
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
            'especies','razas','comportamientos','generos','nivelesActividad','estados','opcionesEntrega','colores','protectora_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'raza_id' => 'nullable|exists:razas,id',
            'color_id' => 'required|exists:colors,id',
            'genero_animal_id' => 'required|exists:genero_animals,id',
            'nivel_actividad_id' => 'required|exists:nivel_actividads,id',
            'comportamientos' => 'required|array|min:1|exists:comportamientos,id',
            'opciones_entrega' => 'nullable|array|exists:opcion_entregas,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'nullable|string|max:5000',
        ]);

        if ($request->hasFile('imagen')) {
            $fileName = 'temporal_animal_' . $protectora->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('imagen')->getClientOriginalExtension();
            $path = $request->file('imagen')->storeAs('animales-temporales', $fileName, 'public');
            $validatedData['imagen'] = $path;
        }

        $validatedData['protectora_id'] = $protectora->id;

        $animalTemporal = AnimalTemporal::create($validatedData);

        if (!empty($validatedData['comportamientos'])) {
            $animalTemporal->comportamientos()->sync($validatedData['comportamientos']);
        }

        if (!empty($validatedData['opciones_entrega'])) {
            $animalTemporal->opcionesEntrega()->sync($validatedData['opciones_entrega']);
        }

        return redirect()->route('perfil-miProtectora.edit', $protectora->id)
                         ->with('success', 'El animal temporal se ha creado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalTemporal $animalTemporal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnimalTemporal $animalTemporal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnimalTemporal $animalTemporal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Auth::user();

        $animalTemporal = AnimalTemporal::where('id', $id)
                                         ->where('protectora_id', $usuario->protectora_id)
                                         ->first();

        if (!$animalTemporal) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este animal temporal.');
        }

        $animalTemporal->delete();

        return redirect()->back()->with('success', 'Animal temporal eliminado correctamente.');
    }
}
