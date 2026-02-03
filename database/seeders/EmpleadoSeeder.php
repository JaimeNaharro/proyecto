<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        Empleado::insert([[
            'nombre' => 'Admin',
            'apellido' => 'Istrador',
            'dni' => '12345678A',
            'correo' => 'admin@concesionario.com',
            'password' => 'admin123',
            'direccion' => 'Calle Principal 1',
            'telefono' => '600000000',
            'rol' => 0,
        ],
        [
            'nombre' => 'Jaime',
            'apellido' => 'Naharro',
            'dni' => '51345678A',
            'correo' => 'jaime@correo.com',
            'password' => 'jaime123',
            'direccion' => 'Calle Principal 2',
            'telefono' => '610000000',
            'rol' => 0,
        ],
        [
            'nombre' => 'Alexander',
            'apellido' => 'Mora',
            'dni' => '50345678A',
            'correo' => 'amora@correo.com',
            'password' => 'alex123',
            'direccion' => 'Calle Principal 3',
            'telefono' => '620000000',
            'rol' => 0,
        ],
        [
            'nombre' => 'Jose',
            'apellido' => 'Gonzalez',
            'dni' => '52345678A',
            'correo' => 'jose@correo.com',
            'password' => 'jose123',
            'direccion' => 'Calle Principal 4',
            'telefono' => '630000000',
            'rol' => 0,
        ]]);
        
    }
}
