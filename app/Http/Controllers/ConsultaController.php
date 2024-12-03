<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\OpcionConsulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $opcionConsultas = OpcionConsulta::all();

        return view('consulta.index', compact('opcionConsultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'shelter' => 'required|exists:opcion_consultas,id',
            'message' => 'required|string|max:1000',
        ]);

        Consulta::create([
            'nombre' => $validatedData['firstName'],
            'apellidos' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'telefono' => $validatedData['phone'] ?? '',
            'mensaje' => $validatedData['message'],
            'opcion_consultas_id' => $validatedData['shelter'],
        ]);

        // return redirect()->back()->with('success', '¡Tu consulta ha sido enviada con éxito!');
        return redirect()->route('consulta.index')->with('success', "¡Tu consulta ha sido enviada con éxito!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
