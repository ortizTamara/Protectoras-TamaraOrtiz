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
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function show($id)
    {
        $animal = Animal::with(['protectora.usuario.pais', 'protectora.usuario.comunidadAutonoma', 'color', 'especie', 'raza', 'comportamientos', 'opcionesEntrega', 'nivelActividad'])
        ->findOrFail($id);

        return view('perfil.protectoras.animales.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        $user = Auth::user();

        if ($user->rol_id !== 1 && $user->protectora_id !== $animal->protectora_id) {
            return redirect()->route('animal.index')->with('error', 'No tienes permiso para editar este animal.');
        }

        $estados = EstadoAnimal::all();
        $especies = Especie::all();
        $razas = Raza::where('especie_id', $animal->especie_id)->get();
        $colores = Color::all();
        $generos = GeneroAnimal::all();
        $nivelesActividad = NivelActividad::all();
        $comportamientos = Comportamiento::all();
        $opcionesEntrega = OpcionEntrega::all();

        return view('perfil.protectoras.animales.edit', compact(
            'animal',
            'estados',
            'especies',
            'razas',
            'colores',
            'generos',
            'nivelesActividad',
            'comportamientos',
            'opcionesEntrega'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, $id)
    {
        // dd($request->all());
        $animal = Animal::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:5000',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric|min:0|max:999.99',
            'genero_animal_id' => 'nullable|exists:genero_animals,id',
            'especie_id' => 'nullable|exists:especies,id',
            'raza_id' => 'nullable|exists:razas,id',
            'comportamientos' => 'nullable|array',
            'opciones_entrega' => 'nullable|array',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_id' => 'nullable|exists:colors,id',
            'nivel_actividad_id' => 'nullable|exists:nivel_actividads,id',
        ]);

        DB::beginTransaction();

        try {
            $animal->update($validatedData);

            if ($request->has('comportamientos')) {
                $animal->comportamientos()->sync($request->input('comportamientos'));
            }

            if ($request->has('opciones_entrega')) {
                $animal->opcionesEntrega()->sync($request->input('opciones_entrega'));
            }

            if ($request->hasFile('imagen')) {
                if ($animal->imagen && Storage::disk('public')->exists($animal->imagen)) {
                    Storage::disk('public')->delete($animal->imagen);
                }

                $fileName = 'animal_' . $animal->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('imagen')->getClientOriginalExtension();
                $path = $request->file('imagen')->storeAs('animales', $fileName, 'public');

                if ($path) {
                    $animal->update(['imagen' => $path]);
                }
            }

            DB::commit();

            return redirect()->route('animal.show', $animal->id)
                ->with('success', 'Animal actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el animal.');
        }
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

    public function marcarFavorito($animalId)
    {
        // Buscar el animal por su ID
        $animal = Animal::findOrFail($animalId);

        // Obtener al usuario autenticado
        $user = auth()->Auth::user();

        // Verificar si el animal ya está en los favoritos del usuario
        if ($user->favoritos->contains($animal)) {
            // Si el animal ya está en los favoritos, lo quitamos
            $user->favoritos()->detach($animalId);
            $isFavorite = false;  // Marcamos como no favorito
        } else {
            // Si no está en los favoritos, lo agregamos
            $user->favoritos()->attach($animalId);
            $isFavorite = true;  // Marcamos como favorito
        }

        // Retornamos una respuesta JSON con el estado del favorito
        return response()->json(['success' => true, 'isFavorite' => $isFavorite]);
    }
}
