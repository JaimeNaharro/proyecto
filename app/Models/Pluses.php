<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pluses extends Model {
    // Relación N:M
    public function vehiculos() {
        return $this->belongsToMany("Vehiculo"::class,"vehiculo_id");
    }
}
