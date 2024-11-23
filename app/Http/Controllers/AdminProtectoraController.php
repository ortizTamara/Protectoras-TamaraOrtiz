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

        //Obtenemos las protectoras activas o pendientes
        $protectoras = Protectora::paginate(8);

        // Obtenemos las protectorados rechazadas
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
        // Buscamos la protectora por ID
        $protectora = Protectora::findOrFail($id);

         // Movemos los datos a la tabla rechazados para tener un control de que protectoras hemos eliminado
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

        // Eleminamos la protectora
        $protectora->delete();

        return redirect()->route('administracion.protectora.index')->with('success', 'La protectora y sus relaciones asociadas han sido gestionadas correctamente.');
    }

    // SOLO LA PROTECTORA Y SUS ANIMALES
    // public function destroy(Protectora $id)
    // {
    //     // Buscamos la protectora
    //     $protectora = Protectora::findOrFail($id);

    //     // Eliminamos los animales asociados a la protectora
    //     if ($protectora->animales) {
    //         $protectora->animales()->delete();
    //     }

    //     // Eliminamos la protectora
    //     $protectora->delete();

    //     // Redirigir con un mensaje de éxito
    //     return redirect()->route('administracion.protectora.index')->with('success', 'La protectora ha sido eliminada y sus animales también. Los usuarios han sido desvinculados.');
    // }

    // BORRANDO PROTECTORA, SUS ANIMALES Y SU USUARIO
    /*
    public function destroy($id)
    {
        // Buscamos la protectora por ID
         $protectora = Protectora::findOrFail($id);

        // Eliminamos el usuario asociado
        if ($protectora->usuario) {
            $protectora->usuario()->delete();
        }

        // Eliminamos los animales asociados a la protectora
        if ($protectora->animales) {
            $protectora->animales()->delete();
        }

        // Eliminamos la protectora
        $protectora->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('administracion.protectora.index')->with('success', 'La protectora y sus relaciones asociadas han sido eliminadas correctamente.');
    }
    */
}
