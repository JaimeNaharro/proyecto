<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtenemos los vehículos con su marca para evitar muchas consultas a la BD
        $vehiculos = \App\Models\Vehiculo::with('marca')->get();
        
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = \App\Models\Marca::all();
        $clientes = \App\Models\Cliente::all(); 

        return view('vehiculos.create', compact('marcas', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación: Guardamos el resultado en una variable ($data)
        $data = $request->validate([
            'matricula'   => 'required|unique:vehiculos',
            'precio'      => 'required|numeric',
            'marca_id'    => 'required|exists:marcas,id',
            'cliente_id'  => 'required|exists:clientes,id',
            'venta_id'  => 'required|exists:ventas,id',
            'tipo'        => 'required|string',
            'transmision' => 'required|string',
            'combustible' => 'nullable|string',
            'km'          => 'nullable|integer',
            'cv'          => 'required|integer',
            'puertas'     => 'required|integer',
            'plazas'      => 'required|integer',
            'color'       => 'required|string',
            'anyo'        => 'required|integer',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // 2. Procesamos la imagen si existe
        if ($request->hasFile('imagen')) {
            // Guardamos la imagen y actualizamos la ruta en el array $data
            $data['imagen'] = $request->file('imagen')->store('vehiculos', 'public');
        }

        // 3. Creamos el registro usando SOLO los datos validados ($data)
        \App\Models\Vehiculo::create($data);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente con su imagen');
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
