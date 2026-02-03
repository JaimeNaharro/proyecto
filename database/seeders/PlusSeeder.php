<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pluses = [
            [
                'nombre' => 'Techo Panorámico',
                'descripcion' => 'Techo de cristal completo con apertura eléctrica y filtro UV.',
                'precio' => 1200.00,
            ],
            [
                'nombre' => 'Navegador Premium',
                'descripcion' => 'Sistema de infoentretenimiento con pantalla de 12" y mapas 3D.',
                'precio' => 850.50,
            ],
            [
                'nombre' => 'Pack Seguridad',
                'descripcion' => 'Cámara 360°, sensores de ángulo muerto y frenada de emergencia.',
                'precio' => 1500.00,
            ],
            [
                'nombre' => 'Sonido Bang & Olufsen',
                'descripcion' => '12 altavoces de alta fidelidad con subwoofer activo.',
                'precio' => 2100.00,
            ],
            [
                'nombre' => 'Asientos de Cuero Nappa',
                'descripcion' => 'Tapicería premium con ajuste lumbar eléctrico y memoria.',
                'precio' => 1850.00,
            ],
            [
                'nombre' => 'Faros Matrix LED',
                'descripcion' => 'Iluminación adaptativa inteligente con intermitentes dinámicos.',
                'precio' => 980.00,
            ],
        ];

        DB::table('pluses')->insert($pluses);
    }
}