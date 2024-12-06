<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        if ($user->protectora_id || $user->rol_id == 1) {
            $protectora = Protectora::find($user->protectora_id);

            return view('perfil.perfilProtectora.index', compact('protectora'));
        }

        return redirect()->route('perfil')->with('error', 'No tienes acceso a esta sección.');
    }

    public function update(Request $request, $id)
    {
        $usuario = Auth::user();
        $protectora = Protectora::find($id);

        if (!$protectora || ($usuario->rol_id != 1 && $usuario->protectora_id != $protectora->id)) {
            return redirect()->route('perfil-protectora.index')->with('error', 'No tienes permiso para modificar esta protectora.');
        }

        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'capacidad_alojamiento' => 'nullable|integer|min:0',
                'nuestra_historia' => 'nullable|string|max:5000',
                'direccion' => 'nullable|string|max:255',
                'telefono_contacto' => 'nullable|string|max:20',
                'instagram' => 'nullable|url',
                'twitter' => 'nullable|url',
                'facebook' => 'nullable|url',
                'web' => 'nullable|url',
            ]);

            $protectora->update($validatedData);

            return redirect()->route('perfil-protectora.index')->with('success', 'Perfil de la protectora actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('perfil-protectora.index')->with('error', 'No se pudo actualizar el perfil de la protectora. Por favor, inténtalo de nuevo.');
        }
    }



       // LOGO PROTECTORA
       public function updateLogo(Request $request)
       {
        $usuario = Auth::user();
        $protectora = Protectora::find($usuario->protectora_id);

        if (!$protectora) {
            return redirect()->back()->with('error', 'No se encontró la protectora.');
        }

        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($protectora->logo && Storage::disk('public')->exists($protectora->logo)) {
                Storage::disk('public')->delete($protectora->logo);
            }

            $fileName = 'protectora_' . $protectora->id . '_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('logo')->getClientOriginalExtension();

            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');

            if ($path) {
                $protectora->logo = $path;
                $protectora->save();
            }
        }

        return redirect()->back()->with('success', 'Logo actualizado correctamente.');
       }

       public function deleteLogo()
       {
        $usuario = Auth::user();
        $protectora = Protectora::find($usuario->protectora_id);

        if (!$protectora || !$protectora->logo) {
            return redirect()->back()->with('error', 'No hay logo para eliminar.');
        }

        if (Storage::disk('public')->exists('logos/' . $protectora->logo)) {
            Storage::disk('public')->delete('logos/' . $protectora->logo);
        }

        $protectora->logo = null;
        $protectora->save();

        return redirect()->back()->with('success', 'Logo eliminado correctamente.');
       }
}
