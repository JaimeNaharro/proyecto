<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
    protected $fillable = ['nombre'];

    // Relación 1:N con Vehiculo
    public function vehiculos() {
        return $this->hasMany(Vehiculo::class);
    }
}


