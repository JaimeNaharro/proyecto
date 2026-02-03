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
            'matricula' => strtoupper(fake()->unique()->bothify('####-???')), 
            'combustible' => fake()->randomElement(['Gasolina', 'Diesel', 'Eléctrico', 'Híbrido']),
            'transmision' => fake()->randomElement(['Manual', 'Automática']),
            'precio' => fake()->randomFloat(2, 10000, 60000), 
            'tipo' => fake()->randomElement(['SUV', 'Compacto', 'Sedán']),
            'color' => fake()->safeColorName(),
            'anyo' => fake()->year(),
            'cv' => fake()->numberBetween(70, 400),
            'km' => fake()->numberBetween(0, 200000),
            'puertas' => fake()->randomElement([3, 5]),
            'plazas' => fake()->randomElement([2, 5, 7]),
            'imagen' => null,
            'marca_id' => \App\Models\Marca::all()->random()->id,
        ];
    }
    
}