<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Empleado;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        Vehiculo::factory(50)->create();
    }
}
