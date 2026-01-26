<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pluses extends Model {
    // Relación inversa N:M
    public function vehiculos_id() {
        return $this->belongsToMany('id')::class;
    }
}
