<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {
    // Relacion 1:N con Cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    // Relación 1:1 con Venta
    public function venta() {
        return $this->belongsTo(Venta::class, "venta_id");
    }

    // Relación N:1 con Marca
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
    // Relación N:M con Pluses
    public function pluses() {
        return $this->belongsToMany(Venta::class, "pluses_id");
    }
}
