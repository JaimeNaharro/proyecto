<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pluses extends Model {
    // Relación N:M
    public function vehiculos_id() {
        return $this->belongsToMany('id')::class;
    }
}
