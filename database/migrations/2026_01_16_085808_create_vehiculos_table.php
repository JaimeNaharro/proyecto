<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->string('combustible');
            $table->string('transmision'); // manual / automatica
            $table->decimal('precio');
            $table->string('tipo');
            $table->string('color');
            $table->year('anio');
            $table->integer('cv');
            $table->integer('km');
            $table->integer('puertas');
            $table->integer('plazas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
