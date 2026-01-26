<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model {
    public function empleado() {
        return $this->belongsTo(Empleado::class);
    }
    public function vehiculos_id(){
        return $this->hasOne("id")::class;
    }
}
