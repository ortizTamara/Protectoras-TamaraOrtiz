<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use App\Http\Requests\StoreProtectoraRequest;
use App\Http\Requests\UpdateProtectoraRequest;

class ProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Obtenemos solo las protectoras aprobadas
        $protectoras = Protectora::where('esValido', true)->get();


        return view('navProtectoras.index', compact('protectoras'));
    }

}
