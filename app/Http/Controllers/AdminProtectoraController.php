<?php

namespace App\Http\Controllers;

use App\Models\Protectora;
use Illuminate\Http\Request;

class AdminProtectoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.protectoras.index', ['protectoras' => Protectora::paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Protectora $protectora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Protectora $protectora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Protectora $protectora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Protectora $protectora)
    {
        //
    }
}
