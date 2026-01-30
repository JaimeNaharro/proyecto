<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // app/Http/Controllers/ClienteController.php

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // 1. Validación (si falla, te devuelve a la misma página)
        $data = $request->validate([
            'dni' => 'required|unique:clientes,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo',
        ]);

        // 2. Si llega aquí, todo está bien.
        \App\Models\Cliente::create($request->all());

        // 3. Redirigimos
        return redirect()->route('vehiculos.index')->with('success', '¡Cliente registrado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
