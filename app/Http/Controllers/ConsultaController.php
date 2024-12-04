<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultaRequest;
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
        $opcionConsultas = \App\Models\OpcionConsulta::all(); // Obtén todas las opciones
        return view('contacto.index', compact('opcionConsultas'));
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
    public function store(StoreConsultaRequest $request)
    {
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'opcion_consultas_id' => 'required|exists:opcion_consultas,id',
        'message' => 'required|string',
    ]);

    // Guardar la consulta en la base de datos
    Consulta::create([
        'nombre' => $request->input('name'),
        'apellidos' => $request->input('surname'),
        'email' => $request->input('email'),
        'telefono' => $request->input('phone'),
        'opcion_consultas_id' => $request->input('opcion_consultas_id'),
        'mensaje' => $request->input('message'),
    ]);

    // Redireccionar con un mensaje de éxito
    return redirect()->route('Contacto.index')->with('success', 'Consulta enviada con éxito.');
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'surname' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'nullable|string|max:15',
        //     'option' => 'required|exists:opcion_consultas,id',
        //     'message' => 'required|string|max:1000',
        // ]);

        // Consulta::create([
        //     'nombre' => $request->input('name'),
        //     'apellidos' => $request->input('surname'),
        //     'email' => $request->input('email'),
        //     'telefono' => $request->input('phone') ?? '',
        //     'mensaje' => $request->input('message'),
        //     'opcion_consultas_id' => $request->input('option'),
        // ]);

        // // return redirect()->back()->with('success', '¡Tu consulta ha sido enviada con éxito!');
        // return redirect()->route('consulta.index')->with('success', "¡Tu consulta ha sido enviada con éxito!");

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
