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
        Schema::create('sesion_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_plan')
                ->constrained('plan_entrenamiento')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->date('fecha');
            $table->string('nombre', 100);
            $table->string('descripcion', 255);
            $table->boolean('completada')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_entrenamiento');
    }
};
