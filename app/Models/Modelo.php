<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model {
    protected $fillable = ['nombre', 'anyo_lanzamiento', 'tipo_carroceria', 'marca_id'];
    // Relación 1:N con marca
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
}
