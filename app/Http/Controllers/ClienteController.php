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

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dni' => 'required|unique:clientes,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo',
            'password' => 'required|min:6',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'vehiculo_id' => 'nullable|exists:vehiculos,id',
        ]);
        $data['rol']=1;
        \App\Models\Cliente::create($data);

        return redirect()->route('login')->with('success', 'Cuenta creada con éxito');
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
