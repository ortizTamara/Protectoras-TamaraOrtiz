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

        // Obtenemos todas las protectoras
        $protectoras = Protectora::all();

        return view('navProtectoras.index', compact('protectoras'));
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
    public function store(StoreProtectoraRequest $request)
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
    public function update(UpdateProtectoraRequest $request, Protectora $protectora)
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
