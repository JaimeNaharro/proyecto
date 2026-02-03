<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nombre' => 'Juan',
            'apellido' => 'García',
            'dni' => '87654321B',
            'correo' => 'juan@correo.com',
            'password' => 'juan123',
            'direccion' => 'Avenida del Sol 45',
            'telefono' => '611223344',
            'rol' => 1,
        ]);
    }
}
