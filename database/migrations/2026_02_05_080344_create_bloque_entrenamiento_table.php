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
        Schema::create('bloque_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->enum('tipo', ['rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test']);
            $table->date('duracion_estimada')->nullable();
            $table->decimal('potencia_pct_min', 5,2)->nullable();
            $table->decimal('potencia_pct_max', 5,2)->nullable();
            $table->decimal('pulso_pct_max', 5,2)->nullable();
            $table->decimal('pulso_reserva_pct', 5,2)->nullable();
            $table->string('comentario', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloque_entrenamiento');
    }
};
