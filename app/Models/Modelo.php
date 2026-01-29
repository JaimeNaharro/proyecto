<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model {
    // Relación 1:N con marca
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
}
