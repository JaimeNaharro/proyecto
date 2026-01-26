<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
    // Relación 1:N con Modelo
    public function modelos() {
        return $this->hasMany(Modelo::class);
    }

    // Relación 1:N con Vehiculo
    public function vehiculos() {
        return $this->hasMany(Vehiculo::class);
    }
}


