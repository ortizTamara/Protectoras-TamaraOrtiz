<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitaController extends Controller
{

    public function index()
    {
        $visitas = Visita::all();

        return view('visita.index', compact('visitas'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para solicitar una visita.');
        }

        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'mensaje' => 'required|string|max:1000',
        ]);

        $usuario = Auth::user();

        $visita = Visita::create([
            'usuario_id' => $usuario->id,
            'animal_id' => $request->animal_id,
            'mensaje' => $request->mensaje,
            'estado' => 'pendiente',
        ]);

        if ($visita) {
            return redirect()->back()->with('success', 'Tu solicitud de visita ha sido enviada.');
        } else {
            return redirect()->back()->with('error', 'Hubo un error al enviar la solicitud.');
        }
    }

    public function aceptar($id)
    {
        $visita = Visita::findOrFail($id);
        $visita->estado = 'aceptada';
        $visita->save();

        return redirect()->back()->with('success', 'La visita ha sido aceptada.');
    }

    public function rechazar($id)
    {
        $visita = Visita::findOrFail($id);
        $visita->estado = 'rechazada';
        $visita->save();

        return redirect()->back()->with('success', 'La visita ha sido rechazada.');
    }
}
