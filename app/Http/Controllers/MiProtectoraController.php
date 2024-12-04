<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MiProtectoraController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $miProtectora = Protectora::find($user->protectora_id);

        if (!$miProtectora) {
            return redirect()->route('perfil')->with('error', 'No tienes una protectora asociada.');
        }

        return view('perfil.protectoras.index', compact('miProtectora'));
    }

    public function show($id)
    {
        // $user = Auth::user();

        // $protectora = Protectora::with('animales')->findOrFail($id);
        $protectora = Protectora::with(['animales', 'animalTemporales'])->findOrFail($id);


        if (!$protectora->esValido) {
            $usuario = Auth::user();

            if ($usuario->protectora_id === $protectora->id) {
                return view('perfil.protectoras.show', compact('protectora'));
            }

            abort(403, 'No tienes permiso para ver esta protectora.');
        }

        $animales = $protectora->animales;

        return view('perfil.protectoras.show', compact('protectora','animales'));
    }

    /*
    public function show($id)
    {
        $protectora = Protectora::with('animales')->findOrFail($id);

        if (!$protectora->esValido) {
            // Si no está logueado, denegar acceso
            if (!auth()->check()) {
                abort(403, 'No tienes permiso para ver esta protectora.');
            }

            $usuario = auth()->user();

            if ($usuario->protectora_id === $protectora->id) {
                // Permitir acceso si el usuario es el propietario
                return view('perfil.protectoras.show', compact('protectora'));
            }

            abort(403, 'No tienes permiso para ver esta protectora.');
        }

        return view('perfil.protectoras.show', compact('protectora'));
    }
    */

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->protectora_id != $id) {
            return redirect()->route('perfil')->with('error', 'No tienes acceso a esta protectora.');
        }

        $protectora = Protectora::findOrFail($id);

        return view('perfil.protectoras.edit', compact('protectora'));
    }

    public function update(Request $request, $id)
    {
        $protectora = Protectora::findOrFail($id);

    // Verificar que el usuario tiene permisos para actualizar esta protectora
    $usuario = Auth::user();
    if ($usuario->protectora_id != $protectora->id) {
        return redirect()->route('perfil')->with('error', 'No tienes acceso a esta protectora.');
    }

    // Validar los datos enviados desde el formulario
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'nuestra_historia' => 'nullable|string|max:5000',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    DB::beginTransaction();

    try {
        // Actualizar los datos generales de la protectora
        $protectora->update([
            'nombre' => $validatedData['nombre'],
            'direccion' => $validatedData['direccion'],
            'nuestra_historia' => $validatedData['nuestra_historia'],
        ]);

        // Manejar la actualización del logo si se envía uno nuevo
        if ($request->hasFile('logo')) {
            if ($protectora->logo && Storage::disk('public')->exists($protectora->logo)) {
                Storage::disk('public')->delete($protectora->logo);
            }

            $fileName = 'protectora_' . $protectora->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('logo')->getClientOriginalExtension();

            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');

            if ($path) {
                $protectora->update(['logo' => $path]);
            }
        }

        if ($request->input('action') === 'save') {

            $animalTemporales = $protectora->animalTemporales;

            foreach ($animalTemporales as $animalTemporal) {
                $animal = Animal::create([
                    'nombre' => $animalTemporal->nombre,
                    'fecha_nacimiento' => $animalTemporal->fecha_nacimiento,
                    'peso' => $animalTemporal->peso,
                    'estado_animal_id' => $animalTemporal->estado_animal_id,
                    'especie_id' => $animalTemporal->especie_id,
                    'raza_id' => $animalTemporal->raza_id,
                    'color_id' => $animalTemporal->color_id,
                    'genero_animal_id' => $animalTemporal->genero_animal_id,
                    'nivel_actividad_id' => $animalTemporal->nivel_actividad_id,
                    'descripcion' => $animalTemporal->descripcion,
                    'imagen' => $animalTemporal->imagen,
                    'protectora_id' => $animalTemporal->protectora_id,
                ]);

                if ($animalTemporal->comportamientos) {
                    $animal->comportamientos()->sync($animalTemporal->comportamientos->pluck('id')->toArray());
                }

                if ($animalTemporal->opcionesEntrega) {
                    $animal->opcionesEntrega()->sync($animalTemporal->opcionesEntrega->pluck('id')->toArray());
                }

                $animalTemporal->delete();
            }

            DB::commit();

            return redirect()->route('perfil-miProtectora.show', $protectora->id)
                ->with('success', 'Protectora y animales actualizados correctamente.');
        } elseif ($request->input('action') === 'cancel') {

            $protectora->animalTemporales()->delete();

            DB::commit();

            return redirect()->route('perfil-miProtectora.show', $protectora->id)
                ->with('info', 'Los cambios han sido descartados y los animales temporales han sido eliminados.');
        }

        throw new \Exception('Acción no válida.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('error', 'Ocurrió un error al procesar tu solicitud.');
    }
    //     $protectora = Protectora::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'nombre' => 'required|string|max:255',
    //         'direccion' => 'required|string|max:255',
    //         'nuestra_historia' => 'nullable|string|max:5000',
    //         'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'added_animals' => 'nullable|array',
    //         'removed_animals' => 'nullable|array',
    //     ]);

    //     $protectora->update([
    //         'nombre' => $validatedData['nombre'],
    //         'direccion' => $validatedData['direccion'],
    //         'nuestra_historia' => $validatedData['nuestra_historia'],
    //     ]);

    //     if ($request->hasFile('logo')) {
    //         if ($protectora->logo && Storage::disk('public')->exists($protectora->logo)) {
    //             Storage::disk('public')->delete($protectora->logo);
    //         }

    //         $fileName = 'protectora_' . $protectora->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('logo')->getClientOriginalExtension();

    //         $path = $request->file('logo')->storeAs('logos', $fileName, 'public');

    //         if ($path) {
    //             $protectora->update(['logo' => $path]);
    //         }
    //     }

    //     $animalTemporales = $protectora->animalTemporales;

    //     foreach ($animalTemporales as $animalTemporal) {
    //         // Crear el Animal permanente con los datos del AnimalTemporal
    //         $animal = Animal::create([
    //             'nombre' => $animalTemporal->nombre,
    //             'fecha_nacimiento' => $animalTemporal->fecha_nacimiento,
    //             'peso' => $animalTemporal->peso,
    //             'estado_animal_id' => $animalTemporal->estado_animal_id,
    //             'especie_id' => $animalTemporal->especie_id,
    //             'raza_id' => $animalTemporal->raza_id,
    //             'color_id' => $animalTemporal->color_id,
    //             'genero_animal_id' => $animalTemporal->genero_animal_id,
    //             'nivel_actividad_id' => $animalTemporal->nivel_actividad_id,
    //             'descripcion' => $animalTemporal->descripcion,
    //             'imagen' => $animalTemporal->imagen,
    //             'protectora_id' => $animalTemporal->protectora_id,
    //         ]);

    //         // Asociar comportamientos si los hay
    //         if ($animalTemporal->comportamientos) {
    //             $animal->comportamientos()->sync($animalTemporal->comportamientos->pluck('id')->toArray());
    //         }

    //         // Asociar opciones de entrega si las hay
    //         if ($animalTemporal->opcionesEntrega) {
    //             $animal->opcionesEntrega()->sync($animalTemporal->opcionesEntrega->pluck('id')->toArray());
    //         }

    //         // Eliminar el registro de AnimalTemporal
    //         $animalTemporal->delete();
    // }

    //     return redirect()->route('perfil-miProtectora.show', $protectora->id)
    //         ->with('success', 'Protectora actualizada correctamente.');
    }

    public function deleteLogo($id)
    {
        $protectora = Protectora::findOrFail($id);

        if ($protectora->logo && Storage::disk('public')->exists('logos/' . $protectora->logo)) {
            Storage::disk('public')->delete('logos/' . $protectora->logo);
        }

        $protectora->logo = null;
        $protectora->save();

        return redirect()->route('perfil-miProtectora.edit', $protectora->id)
            ->with('success', 'Logo eliminado correctamente.');
    }

}
