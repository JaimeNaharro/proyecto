<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;
class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marca::insert([
            ['nombre' => 'Audi'],
            ['nombre' => 'Aston Martin'],
            ['nombre' => 'Alpine'],
            ['nombre' => 'Alfa Romeo'],
            ['nombre' => 'BMW'],
            ['nombre' => 'Cupra'],
            ['nombre' => 'Dacia'],
            ['nombre' => 'Kia'],
            ['nombre' => 'Ferrari'],
            ['nombre' => 'Ford'],
            ['nombre' => 'Honda'],
            ['nombre' => 'Hyundai'],
            ['nombre' => 'Jaguar'],
            ['nombre' => 'Jeep'],
            ['nombre' => 'Lamborghini'],
            ['nombre' => 'Land Rover'],
            ['nombre' => 'McLaren'],
            ['nombre' => 'Mercedes'],
            ['nombre' => 'Nissan'],
            ['nombre' => 'Peugeot'],
            ['nombre' => 'Porsche'],
            ['nombre' => 'Renault'],
            ['nombre' => 'Rolls-Royce'],
            ['nombre' => 'Seat'],
            ['nombre' => 'Tesla'],
            ['nombre' => 'Toyota'],
            ['nombre' => 'Volkswagen'],
            ['nombre' => 'Volvo'],
        ]);
  
    }
}