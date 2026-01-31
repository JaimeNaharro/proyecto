<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plus extends Model {
    protected $fillable = ['nombre', 'descripcion', 'precio'];
    // Relación N:M
    public function vehiculos() {
        return $this->belongsToMany(Vehiculo::class,"plus_vehiculo");
    }
}
