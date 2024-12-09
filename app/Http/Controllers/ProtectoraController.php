<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use App\Http\Requests\StoreProtectoraRequest;
use App\Http\Requests\UpdateProtectoraRequest;
use Illuminate\Http\Request;

class ProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el término de búsqueda desde la petición
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtramos las protectoras por nombre
        if ($search) {
            $protectoras = Protectora::where('esValido', true)
                ->where('nombre', 'like', '%' . $search . '%')
                ->get();
        } else {
            // Si no hay búsqueda, obtener todas las protectoras válidas
            $protectoras = Protectora::where('esValido', true)->get();
        }
        // $protectoras = Protectora::where('esValido', true)->get();


        return view('navProtectoras.index', compact('protectoras'));
    }



}
