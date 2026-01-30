<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => fake()->unique()->bothify('####-???'), // Genera algo como 1234-ABC
            'combustible' => fake()->randomElement(['Gasolina', 'Diesel', 'Eléctrico', 'Híbrido']),
            'transmision' => fake()->randomElement(['Manual', 'Automática']),
            'precio' => fake()->randomFloat(2, 10000, 60000), // Precio entre 10k y 60k
            'tipo' => fake()->randomElement(['SUV', 'Compacto', 'Sedán']),
            'color' => fake()->safeColorName(),
            'anyo' => fake()->year(),
            'cv' => fake()->numberBetween(70, 400),
            'km' => fake()->numberBetween(0, 200000),
            'puertas' => fake()->randomElement([3, 5]),
            'plazas' => fake()->randomElement([2, 5, 7]),
            'imagen' => null,
            // Relaciones aleatorias (asume que ya existen marcas, clientes y ventas)
            'marca_id' => \App\Models\Marca::all()->random()->id,
            'cliente_id' => \App\Models\Cliente::all()->random()->id,
            'venta_id' => \App\Models\Venta::all()->random()->id,
        ];
    }
}
