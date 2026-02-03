<?php

use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('vehiculos.index');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registro', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/registro', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');

// RUTAS ADMIN
Route::middleware(['admin'])->group(function () {
    
    Route::get('/vehiculos/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
    
    Route::get('/vehiculos/{id}/edit', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
    Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])->name('vehiculos.update');
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');
    
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
});

Route::get('/vehiculos/{id}', [VehiculoController::class, 'show'])->name('vehiculos.show');

// RUTAS CLIENTE
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/mi-perfil', [LoginController::class, 'perfil'])->name('cliente.perfil');
Route::post('/cancelar-compra/{vehiculo_id}', [VehiculoController::class, 'cancelarCompra'])->name('vehiculos.cancelar');