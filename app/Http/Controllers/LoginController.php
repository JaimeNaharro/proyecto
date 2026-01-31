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

        // Buscar Empleado
        $empleado = Empleado::where('correo', $correo)->where('password', $password)->first();
        if ($empleado) {
            // IMPORTANTE: Guardar en sesión
            session(['usuario_nombre' => $empleado->nombre, 'usuario_rol' => 'admin']);
            return redirect()->route('vehiculos.create');
        }

        // Buscar Cliente
        $cliente = Cliente::where('correo', $correo)->where('password', $password)->first();
        if ($cliente) {
            // IMPORTANTE: Guardar en sesión
            session(['usuario_nombre' => $cliente->nombre, 'usuario_rol' => 'cliente', 'cliente_id' => $cliente->id]);
            return redirect()->route('vehiculos.index');
        }

        return back()->with('error', 'Correo o contraseña incorrectos.');
    }
    public function logout() 
    {
        session()->forget(['usuario_nombre', 'usuario_rol', 'cliente_id']);
        return redirect()->route('login');
    }
    public function perfil()
    {
        $clienteId = session('cliente_id');
        if (!$clienteId) return redirect()->route('login');

        // IMPORTANTE: Usamos with('vehiculos') para que no llegue null
        $cliente = Cliente::with('vehiculos.marca')->find($clienteId);

        return view('registro.perfil', compact('cliente'));
    }
    
}