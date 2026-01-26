<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {
    // Relación inversa con Cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    // Relación 1:1 con Venta
    public function venta_id() {
        return $this->belongsTo("id")::class;
    }

    // Relación N:1 con Marca
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
    // Relación N:M con Pluses
    public function pluses_id() {
        return $this->belongsToMany('id')::class;
    }
}
