<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /*
        protected $table = "clientes";
        protected $fillable = ["nombre,	apellido, dni, correo, direccion, telefono"];
        protected $guarded = ["id"];
    */

    public function cliente() {
        return $this->belongsTo(Cliente::class); 
    }
    public function marca() { 
        return $this->belongsTo(Marca::class); 
    }
    public function venta() { 
        return $this->hasOne(Venta::class); 
    }
    public function pluses() { 
        return $this->belongsToMany(Pluses::class, 'plus_vehiculo'); 
    }
}
