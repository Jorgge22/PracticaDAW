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
        Schema::create('plan_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('nombre', '100');
            $table->string('descripcion', '255');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('objetivo', '100');
            $table->boolean('activo')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_entrenamiento');
    }
};
