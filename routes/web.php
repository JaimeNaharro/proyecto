<?php

use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

// Ruta para VER el formulario
Route::get('/registro', [ClienteController::class, 'create'])->name('clientes.create');

// Ruta para PROCESAR el formulario (LA QUE FALTA)
Route::post('/registro', [ClienteController::class, 'store'])->name('clientes.store');

Route::resource('vehiculos', VehiculoController::class);
Route::resource('ventas', VentaController::class);