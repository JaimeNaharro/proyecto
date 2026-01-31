<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model {
    protected $fillable = ['precio', 'fecha', 'precio_final', 'metodo_pago', 'empleado_id', 'vehiculo_id'];
    // Relación 1:N con Empleado
    public function empleado() {
        return $this->belongsTo(Empleado::class);
    }
    // Relación 1:1 con Vehiculo
    public function vehiculo() {
    return $this->belongsTo(Vehiculo::class, 'venta_id');
}
}
