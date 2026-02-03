<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Cliente;

class LoginController extends Controller
{
    public function showLogin() {
        return view('registro.login');
    }

    public function login(Request $request) 
    {
        $correo = $request->input('correo');
        $password = $request->input('password');

        // 1. Intentar buscar Empleado (Administrador - Rol 0)
        $empleado = Empleado::where('correo', $correo)->where('password', $password)->first();
        if ($empleado) {
            session([
                'usuario_nombre' => $empleado->nombre, 
                'usuario_rol'    => (int)$empleado->rol // Guardamos 0
            ]);
            // El admin va al catálogo para gestionar
            return redirect()->route('vehiculos.index');
        }

        // 2. Intentar buscar Cliente (Comprador - Rol 1)
        $cliente = Cliente::where('correo', $correo)->where('password', $password)->first();
        if ($cliente) {
            session([
                'usuario_nombre' => $cliente->nombre, 
                'usuario_rol'    => (int)$cliente->rol, // Guardamos 1
                'cliente_id'     => $cliente->id
            ]);
            return redirect()->route('vehiculos.index');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout() 
    {
        session()->flush();
        return redirect()->route('login');
    }

    public function perfil()
    {
        $clienteId = session('cliente_id');
        if (!$clienteId) return redirect()->route('login');

        $cliente = Cliente::with('vehiculos.marca')->findOrFail($clienteId);
        return view('registro.perfil', compact('cliente'));
    }
}