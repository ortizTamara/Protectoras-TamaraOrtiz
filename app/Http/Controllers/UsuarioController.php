<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carga los usuarios con las relaciones rol y protectora
        $usuarios = Usuario::with('rol', 'protectora')->get();

        // Retorna la vista con los usuarios
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Nuevo Usuario";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
    // Cargar las relaciones 'rol' y 'protectora' en el objeto $usuario
    $usuario->load('rol', 'protectora');

    return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function showProfile(Usuario $usuario)
    {
        $usuario = auth()->$usuario(); // Obtiene al usuario autenticado

        // Retorna la vista con los datos del usuario
        return view('usuarios.profile', compact('usuario'));
    }


    // FOTO USUARIO
    public function updateFoto(Request $request)
    {
        // Validamos la foto
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $usuario = Auth::user();

        if (!$usuario || !$usuario instanceof \App\Models\Usuario) {
            return redirect()->back()->with('error', 'Usuario no autenticado o inválido.');
        }

        // Verificamos si el usuario subió una foto, si es asi eliminamos la anterior.
        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }

            // Generamos el nombre personalizado
            $fileName = $usuario->id . '_' . date('Y-m-d_H-i-s') . '.' . $request->file('foto')->getClientOriginalExtension();

            // Guardamos la imagen en /fotos con el nombre personalizado
            $path = $request->file('foto')->storeAs('fotos', $fileName, 'public');

            // Verficiamos que la imagen se haya almacenado
            if ($path) {
                // Lo guardamos con update
                $usuario->update(['foto' => $path]);
                return redirect()->back()->with('success', 'Foto actualizada correctamente.');
            }

            return redirect()->back()->with('error', 'No se pudo guardar la imagen.');
        }

        return redirect()->back()->with('error', 'No se recibió ninguna foto.');
    }

    // BORRAR IMAGEN
    public function deleteLogo()
    {
        // Obtener la protectora asociada al usuario autenticado
        $usuario = Auth::user();
        $protectora = Protectora::find($usuario->protectora_id);

        if (!$protectora || !$protectora->logo) {
            return redirect()->back()->with('error', 'No hay logo para eliminar.');
        }

        // Verificar si el archivo existe antes de intentar eliminarlo
        if (Storage::disk('public')->exists($protectora->logo)) {
            Storage::disk('public')->delete($protectora->logo);
        } else {
            return redirect()->back()->with('error', 'El archivo no existe en el almacenamiento.');
        }

        // Actualizar el campo `logo` a null en la base de datos
        $protectora->logo = null;
        $protectora->save();

        return redirect()->back()->with('success', 'Logo eliminado correctamente.');
    }



}
