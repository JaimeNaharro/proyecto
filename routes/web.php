<?php

use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registro', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/registro', [ClienteController::class, 'store'])->name('clientes.store');

Route::resource('vehiculos', VehiculoController::class);
Route::resource('ventas', VentaController::class);

// Info del coche
Route::get('/vehiculos/{id}', [VehiculoController::class, 'show'])->name('vehiculos.info');

// Comprar
Route::post('/comprar/{vehiculo_id}', [VehiculoController::class, 'comprar'])->name('vehiculos.comprar');

Route::get('/mi-perfil', [LoginController::class, 'perfil'])->name('cliente.perfil');
Route::post('/cancelar-compra/{vehiculo_id}', [VehiculoController::class, 'cancelarCompra'])->name('vehiculos.cancelar');