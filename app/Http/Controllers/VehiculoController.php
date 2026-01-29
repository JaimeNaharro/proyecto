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
        $modelos = \App\Models\Modelo::all();
        $clientes = \App\Models\Cliente::all(); // Según tu E/R el vehículo posee un cliente

        return view('vehiculos.create', compact('marcas', 'modelos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación: Incluimos la imagen y el resto de campos que tienes en el blade
        $data = $request->validate([
            'matricula' => 'required|unique:vehiculos',
            'precio' => 'required|numeric',
            'marca_id' => 'required|exists:marcas,id',
            'cliente_id' => 'required|exists:clientes,id',
            'combustible' => 'nullable|string',
            'km' => 'nullable|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // 2. Preparamos los datos para guardar
        $input = $request->all();

        // 3. Procesamos la imagen si el usuario la ha subido
        if ($request->hasFile('imagen')) {
            // Guarda la imagen en storage/app/public/vehiculos
            $rutaImagen = $request->file('imagen')->store('vehiculos', 'public');
            
            // Cambiamos el valor de 'imagen' por la ruta del archivo para la BD
            $input['imagen'] = $rutaImagen;
        }

        // 4. Creamos el registro con los datos procesados
        \App\Models\Vehiculo::create($input);

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
