<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
            'tipo'        => 'required|string',
            'transmision' => 'required|string',
            'combustible' => 'nullable|string',
            'km'          => 'nullable|integer',
            'cv'          => 'required|integer',
            'puertas'     => 'required|integer',
            'plazas'      => 'required|integer',
            'color'       => 'required|string',
            'anyo'        => 'required|integer',
            'imagen'      => 'nullable|image|max:2048', 
        ]);

        // 2. Procesamos la imagen si existe
        if ($request->hasFile('imagen')) {
        // Leemos el archivo y lo convertimos en contenido binario
            $data['imagen'] = file_get_contents($request->file('imagen')->getRealPath());
        }

        // 3. Creamos el registro usando SOLO los datos validados ($data)
        \App\Models\Vehiculo::create($data);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente con su imagen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscamos el vehículo con su marca
        $vehiculo = \App\Models\Vehiculo::with('marca')->findOrFail($id);
        
        return view('vehiculos.info', compact('vehiculo'));
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
    // COMPRAR
    public function comprar($vehiculo_id) {
        $clienteId = session('cliente_id');
        if (!$clienteId) return redirect()->route('login');

        $vehiculo = \App\Models\Vehiculo::findOrFail($vehiculo_id);
        
        $vehiculo->cliente_id = $clienteId;
        $vehiculo->save();

        return back()->with('success', '¡Coche añadido a tu garaje!');
    }

    // CANCELAR (Devolver un coche específico)
    public function cancelarCompra($vehiculo_id) {
        $vehiculo = \App\Models\Vehiculo::findOrFail($vehiculo_id);
        
        // Verificamos que el coche sea de este cliente antes de borrar
        if ($vehiculo->cliente_id == session('cliente_id')) {
            $vehiculo->cliente_id = null;
            $vehiculo->save();
            return back()->with('success', 'Coche devuelto al inventario.');
        }
        
        return back()->with('error', 'No puedes devolver un coche que no es tuyo.');
    }
}
