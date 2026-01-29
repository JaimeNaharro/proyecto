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
        // 1. Creamos una marca si no existe
        $marca = Marca::firstOrCreate(['nombre' => 'Toyota']);

        // 2. Creamos un cliente de prueba
        $cliente = Cliente::firstOrCreate(
            ['dni' => '12345678Z'],
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'correo' => 'juan@example.com',
                'direccion' => 'Calle Falsa 123',
                'telefono' => '600112233'
            ]
        );

        // 3. Creamos un empleado y una venta (necesaria por tu migración)
        $empleado = Empleado::firstOrCreate(['dni' => '87654321X'], [
            'nombre' => 'Ana',
            'apellido' => 'García',
            'correo' => 'ana@concesionario.com',
            'direccion' => 'Av. Central 1',
            'telefono' => '699887766'
        ]);

        $venta = Venta::create([
            'precio' => 15000,
            'fecha' => now(),
            'precio_final' => 14500,
            'metodo_pago' => 'Transferencia',
            'empleado_id' => $empleado->id
        ]);

        // 4. Insertamos el vehículo de prueba
        Vehiculo::create([
            'matricula' => '1234-BBB',
            'combustible' => 'Híbrido',
            'transmision' => 'Automática',
            'precio' => 25000.00,
            'tipo' => 'SUV',
            'color' => 'Blanco',
            'anyo' => 2023,
            'cv' => 140,
            'km' => 5000,
            'puertas' => 5,
            'plazas' => 5,
            'imagen' => null,
            'cliente_id' => $cliente->id,
            'marca_id' => $marca->id,
            'venta_id' => $venta->id,
        ]);
        Vehiculo::factory(50)->create();
    }
}
