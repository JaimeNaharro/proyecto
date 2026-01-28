<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model {
    // Relacion 1:N con Ventas
    public function ventas() {
        return $this->hasMany(Venta::class);
    }
}