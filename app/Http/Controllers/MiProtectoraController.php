<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MiProtectoraController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener la protectora asociada al usuario autenticado
        $miProtectora = Protectora::find($user->protectora_id);

        if (!$miProtectora) {
            return redirect()->route('perfil')->with('error', 'No tienes una protectora asociada.');
        }

        // Pasar los datos a la vista
        return view('perfil.protectoras.index', compact('miProtectora'));
    }

    public function show($id)
    {
        // $user = Auth::user();

        $protectora = Protectora::with('animales')->findOrFail($id);

      // Validamos si la protectora no está aprobada
        if (!$protectora->esValido) {
            // Verificamos si el usuario actual está vinculado a esta protectora
            $usuario = Auth::user(); // Obtener el usuario autenticado

            // Verificamos si el usuario es una protectora y está vinculado a esta protectora
            if ($usuario->protectora_id === $protectora->id) {
                return view('perfil.protectoras.show', compact('protectora'));
            }

            // Si no es propietario, denegar acceso
            abort(403, 'No tienes permiso para ver esta protectora.');
        }


        return view('perfil.protectoras.show', compact('protectora'));
    }

    /*
    public function show($id)
    {
        // Buscar la protectora con sus relaciones (animales)
        $protectora = Protectora::with('animales')->findOrFail($id);

        // Validar si la protectora no está aprobada
        if (!$protectora->esValido) {
            // Si no está logueado, denegar acceso
            if (!auth()->check()) {
                abort(403, 'No tienes permiso para ver esta protectora.');
            }

            // Obtener el usuario autenticado
            $usuario = auth()->user();

            // Verificar si el usuario es el propietario de la protectora
            if ($usuario->protectora_id === $protectora->id) {
                // Permitir acceso si el usuario es el propietario
                return view('perfil.protectoras.show', compact('protectora'));
            }

            // Si no es propietario, denegar acceso
            abort(403, 'No tienes permiso para ver esta protectora.');
        }

        // Si la protectora está aprobada, permitir el acceso público
        return view('perfil.protectoras.show', compact('protectora'));
    }
    */

    public function edit($id)
    {
        $user = Auth::user();

        // Verificamos que el usuario tiene una protectora asociada
        if ($user->protectora_id != $id) {
            return redirect()->route('perfil')->with('error', 'No tienes acceso a esta protectora.');
        }

        // Obtener la protectora asociada
        $protectora = Protectora::findOrFail($id);

        return view('perfil.protectoras.edit', compact('protectora'));
    }

    public function update(Request $request, $id)
    {
        $protectora = Protectora::findOrFail($id);

        // Validar los datos enviados desde el formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'nuestra_historia' => 'nullable|string|max:5000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación del logo
        ]);

        // Actualizar los datos generales de la protectora
        $protectora->update([
            'nombre' => $validatedData['nombre'],
            'direccion' => $validatedData['direccion'],
            'nuestra_historia' => $validatedData['nuestra_historia'],
        ]);

        // Manejar la actualización del logo si se envía uno nuevo
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($protectora->logo && Storage::disk('public')->exists('logos/' . $protectora->logo)) {
                Storage::disk('public')->delete('logos/' . $protectora->logo);
            }

            // Subir el nuevo logo
            $path = $request->file('logo')->store('logos', 'public');
            $protectora->logo = basename($path);
            $protectora->save();
        }

        // Redirigir al usuario a la vista 'show' con un mensaje de éxito
        return redirect()->route('perfil-miProtectora.show', $protectora->id)
            ->with('success', 'Protectora actualizada correctamente.');
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
