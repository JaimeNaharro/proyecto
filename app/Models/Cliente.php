<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Relacion 1:N con Vehiculos
    public function vehiculos() {
        return $this->hasMany(Vehiculo::class);
    }
}
