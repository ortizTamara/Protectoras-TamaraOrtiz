<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $protectoras = Protectora::paginate(8);

        $rechazadas = DB::table('rechazados')->get();

        return view('administrador.protectoras.index', [
            'protectoras' => $protectoras,
            'rechazadas' => $rechazadas,
        ]);
    }

    public function validar($id)
    {
        $protectora = Protectora::findOrFail($id);
        $protectora->esValido = true;
        $protectora->save();

        return redirect()->route('administracion.protectora.index')->with('success', 'La protectora ha sido validada correctamente.');
    }

    public function destroy(Request $request, $id)
    {
        $protectora = Protectora::findOrFail($id);

        DB::table('rechazados')->insert([
        'nombre' => $protectora->nombre,
        'numero_registro_oficial' => $protectora->numero_registro_oficial,
        'capacidad_alojamiento' => $protectora->capacidad_alojamiento,
        'nuestra_historia' => $protectora->nuestra_historia,
        'direccion' => $protectora->direccion,
        'telefono_contacto' => $protectora->telefono_contacto,
        'instagram' => $protectora->instagram,
        'twitter' => $protectora->twitter,
        'facebook' => $protectora->facebook,
        'web' => $protectora->web,
        'logo' => $protectora->logo,
        'motivo_rechazo' => $request->input('motivo_rechazo'),
        ]);

        $protectora->delete();

        return redirect()->route('administracion.protectora.index')->with('success', 'La protectora y sus relaciones asociadas han sido gestionadas correctamente.');
    }

}
