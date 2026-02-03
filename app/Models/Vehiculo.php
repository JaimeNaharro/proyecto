<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {
    use HasFactory;
    protected $fillable = ['matricula', 'precio', 'marca_id', 'tipo', 'transmision', 'combustible', 'km', 'cv', 'puertas', 'plazas', 'color', 'anyo', 'imagen','cliente_id'];
    // Relacion 1:N con Cliente
    public function clientes(){
        return $this->belongsTo(Cliente::class);
    }
    // Relación 1:1 con Venta
    public function venta() {
        return $this->hasOne(Venta::class, "vehiculo_id");
    }
    // Relación N:1 con Marca
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
    // Relación N:M con Pluses
    public function pluses() {
        return $this->belongsToMany(Plus::class, 'plus_vehiculo');
    }
}