<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Plus;

class VehiculoController extends Controller
{
    // Catálogo con buscador y filtrado de disponibilidad
    public function index(Request $request)
    {
        $query = Vehiculo::with('marca')->whereNull('cliente_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('matricula', 'LIKE', "%{$search}%")
                  ->orWhereHas('marca', function($m) use ($search) {
                      $m->where('nombre', 'LIKE', "%{$search}%");
                  });
            });
        }

        $vehiculos = $query->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    // Formulario para añadir nuevo coche
    public function create()
    {
        $marcas = Marca::all();
        $todosLosPluses = Plus::all();
        return view('vehiculos.create', compact('marcas', 'todosLosPluses'));
    }

    // Guardar nuevo coche
    public function store(Request $request)
    {
        $vehiculo = Vehiculo::create($request->all());
        if ($request->has('pluses')) {
            $vehiculo->pluses()->attach($request->input('pluses'));
        }
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $vehiculo->imagen = file_get_contents($file->getRealPath());
        }

        $vehiculo->save();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo registrado.');
    }

    // Formulario de edición con carga de extras
    public function edit($id)
    {
        $vehiculo = Vehiculo::with('pluses')->findOrFail($id);
        $marcas = Marca::all();
        $todosLosPluses = Plus::all();
        return view('vehiculos.edit', compact('vehiculo', 'marcas', 'todosLosPluses'));
    }

    // Actualizar datos y sincronizar pluses
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->only(['precio', 'marca_id', 'km']));

        if ($request->has('pluses')) {
            $vehiculo->pluses()->sync($request->input('pluses'));
        } else {
            $vehiculo->pluses()->detach();
        }
        return redirect()->route('vehiculos.index')->with('success', 'Coche actualizado.');
    }
    // Método para devolver un coche desde el perfil del cliente
    public function cancelarCompra($vehiculo_id) 
    {
        $clienteId = session('cliente_id');
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        
        // 1. Buscamos la venta de este cliente con este vehículo y la borramos
        \App\Models\Venta::where('vehiculo_id', $vehiculo_id)
            ->where('cliente_id', $clienteId)
            ->delete();

        // 2. Liberamos el vehículo
        $vehiculo->update(['cliente_id' => null]);

        return back()->with('success', 'Vehículo devuelto y registro eliminado del historial.');
    }

    // Comprar para clientes
    public function comprar($vehiculo_id) 
    {
        $clienteId = session('cliente_id');
        if (!$clienteId) return redirect()->route('login');

        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        $vehiculo->cliente_id = $clienteId;
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', '¡Compra realizada con éxito!');
    }

    public function show($id) {
        // Buscamos el vehículo con su marca
        $vehiculo = Vehiculo::with('marca')->findOrFail($id);
        
        // Pluses
        $todosLosPluses = Plus::all(); 
        
        // Pasamos ambos a la vista info.blade.php
        return view('vehiculos.info', compact('vehiculo', 'todosLosPluses'));
    }

    public function destroy($id) {
        Vehiculo::findOrFail($id)->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Coche eliminado.');
    }
}