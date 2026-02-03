<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['cliente', 'vehiculo'])->get();
        return view('ventas.index', compact('ventas'));
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
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'metodo_pago' => 'required|string',
            'pluses_elegidos' => 'nullable|array'
        ]);

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        $clienteId = session('cliente_id');

        try {
            DB::beginTransaction();

            $precioFinal = $vehiculo->precio;
            if ($request->has('pluses_elegidos')) {
                $precioExtras = \App\Models\Plus::whereIn('id', $request->pluses_elegidos)->sum('precio');
                $precioFinal += $precioExtras;
            }

            Venta::create([
                'precio' => $vehiculo->precio,
                'fecha' => now(),
                'precio_final' => $precioFinal,
                'metodo_pago' => $request->metodo_pago,
                'cliente_id' => $clienteId,
                'vehiculo_id' => $vehiculo->id,
            ]);

            $vehiculo->update(['cliente_id' => $clienteId]);

            DB::commit();
            return redirect()->route('cliente.perfil')->with('success', '¡Compra realizada por ' . number_format($precioFinal, 0) . '€!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la compra.');
        }
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
