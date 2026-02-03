<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model {
    protected $fillable = ['precio', 'fecha', 'precio_final', 'metodo_pago', 'cliente_id', 'vehiculo_id'];
    // Relación 1:N con Empleado
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
    // Relación 1:1 con Vehiculo
    public function vehiculo() {
    return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
}
}
