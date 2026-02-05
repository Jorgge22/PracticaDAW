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
            $table->string('nombre', '100');
            $table->string('descripcion', '255');
            $table->enum('tipo', ['rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test']);
            $table->date('duracion_estimada');
            $table->decimal('potencia_pct_min', 5,2);
            $table->decimal('potencia_pct_max', 5,2);
            $table->decimal('pulso_pct_max', 5,2);
            $table->decimal('pulso_reserva_pct', 5,2);
            $table->string('comentario', '255');
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
