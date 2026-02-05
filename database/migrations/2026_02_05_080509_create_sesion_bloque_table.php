<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_sesion_entrenamiento')
                ->constrained('sesion_entrenamiento') 
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('id_bloque_entrenamiento')
                ->constrained('bloque_entrenamiento') 
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('orden');
            $table->integer('repeticiones')->default(1);

            $table->unique(
                ['id_sesion_entrenamiento', 'id_bloque_entrenamiento', 'orden'], 'uq_sesion_bloque_orden'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesion_bloque');
    }
};
