<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MiProtectoraController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $miProtectora = Protectora::find($user->protectora_id);

        // if (!$miProtectora) {
        //     return redirect()->route('perfil')->with('error', 'No tienes una protectora asociada.');
        // }

        if ($user->protectora_id || $user->rol_id == 1) {
            $protectora = Protectora::find($user->protectora_id);

            return view('perfil.protectoras.index', compact('miProtectora'));
        }

        return redirect()->route('perfil')->with('error', 'No tienes acceso a esta sección.');

        // return view('perfil.protectoras.index', compact('miProtectora'));
    }

    public function show($id)
    {
        $protectora = Protectora::with(['animales', 'animalTemporales'])->findOrFail($id);
        $usuario = Auth::user();

        // Si la protectora no está validada
        if (!$protectora->esValido) {
            // Permitir acceso solo si el usuario es dueño de la protectora
            if ($usuario->protectora_id !== $protectora->id) {
                abort(403, 'No tienes permiso para ver esta protectora.');
            }

            // Si es el dueño, mostrar la vista con un mensaje
            return view('perfil.protectoras.show', [
                'protectora' => $protectora,
                'animales' => $protectora->animales,
                'enAdopcion' => 0,
                'urgentes' => 0,
                'enAcogida' => 0,
                'mensaje' => 'Tu protectora aún no ha sido aprobada por el administrador.',
            ]);
        }

        // Si está validada, calcular estadísticas normalmente
        $animales = $protectora->animales;
        $enAdopcion = $animales->where('estado_animal_id', 1)->count();
        $urgentes = $animales->where('estado_animal_id', 2)->count();
        $enAcogida = $animales->where('estado_animal_id', 3)->count();

        return view('perfil.protectoras.show', compact('protectora', 'animales', 'enAdopcion', 'urgentes', 'enAcogida'));
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->protectora_id != $id) {
            return redirect()->route('perfil')->with('error', 'No tienes acceso a esta protectora.');
        }

        $protectora = Protectora::findOrFail($id);

        // Log::info('Editando protectora:', $protectora->toArray());

        return view('perfil.protectoras.edit', compact('protectora'));
    }

    public function update(Request $request, $id)
    {
        $protectora = Protectora::findOrFail($id);

        $usuario = Auth::user();
        if ($usuario->protectora_id != $protectora->id) {
            return redirect()->route('perfil')->with('error', 'No tienes acceso a esta protectora.');
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'nuestra_historia' => 'nullable|string|max:5000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $protectora->update([
                'nombre' => $validatedData['nombre'],
                'direccion' => $validatedData['direccion'],
                'nuestra_historia' => $validatedData['nuestra_historia'],
            ]);

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

                $animalesParaEliminar = $protectora->animales()->where('marcado_para_eliminar', true)->get();

                foreach ($animalesParaEliminar as $animal) {
                    $animal->delete();
                }

                DB::commit();

                return redirect()->route('perfil-miProtectora.show', $protectora->id)
                    ->with('success', 'Protectora y animales actualizados correctamente.');
            } elseif ($request->input('action') === 'cancel') {

                $protectora->animalTemporales()->delete();

                $protectora->animales()->where('marcado_para_eliminar', true)->update(['marcado_para_eliminar' => false]);

                DB::commit();

                return redirect()->route('perfil-miProtectora.show', $protectora->id)
                    ->with('info', 'Los cambios han sido descartados y los animales temporales han sido eliminados.');
            }

            throw new \Exception('Acción no válida.');
            } catch (\Exception $e) {
                DB::rollBack();

            return redirect()->back()->with('error', 'Ocurrió un error al procesar tu solicitud.');
        }
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
