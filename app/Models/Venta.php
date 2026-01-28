<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model {
    // Relación 1:N con Empleado
    public function empleado() {
        return $this->belongsTo(Empleado::class);
    }
    // Relación 1:1 con Vehiculo
    public function vehiculos_id(){
        return $this->hasOne("id")::class;
    }
}
