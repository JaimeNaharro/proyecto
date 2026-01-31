<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        Empleado::create([
            'nombre' => 'Admin',
            'apellido' => 'Istrador',
            'dni' => '12345678A',
            'correo' => 'admin@concesionario.com',
            'password' => 'admin123',
            'direccion' => 'Calle Principal 1',
            'telefono' => '600000000',
            'rol' => 0,
        ]);
    }
}
