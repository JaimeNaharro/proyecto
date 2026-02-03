<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'dni', 'correo', 'password','direccion', 'telefono', 'rol'];
    
    // Relacion 1:N con Vehiculos
    public function vehiculos() {
        return $this->hasMany(Vehiculo::class);
    }
    // Relacion 1:N con Ventas
    public function ventas() {
        return $this->hasMany(Venta::class);
    }
}
