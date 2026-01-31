<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model {

    protected $fillable = ['nombre', 'apellido', 'dni', 'correo', 'direccion', 'rol','telefono'];

    // Relacion 1:N con Ventas
    public function ventas() {
        return $this->hasMany(Venta::class);
    }
}