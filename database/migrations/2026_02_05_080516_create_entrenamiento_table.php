<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_ciclista');
            $table->foreign('id_ciclista')
                ->references('id')
                ->on('ciclista')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('id_bicicleta')
                ->constrained('bicicleta') 
                ->onDelete('restrict')     
                ->onUpdate('cascade');     

            $table->foreignId('id_sesion')
                ->nullable()               
                ->constrained('sesion_entrenamiento')
                ->onDelete('set null')     
                ->onUpdate('cascade');     

            $table->dateTime('fecha');
            $table->time('duracion');
            $table->decimal('kilometros', 6, 2); 
            $table->string('recorrido', 150);
            $table->integer('pulso_medio')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('potencia_media')->nullable();
            $table->integer('potencia_normalizada');
            $table->decimal('velocidad_media', 5, 2); 
            $table->decimal('puntos_estres_tss', 6, 2)->nullable(); 
            $table->decimal('factor_intensidad_if', 4, 3)->nullable();
            $table->integer('ascenso_metros')->nullable();
            $table->string('comentario', 255)->nullable();

            $table->index(['id_ciclista', 'fecha'], 'idx_ciclista_fecha');
            $table->index('fecha', 'idx_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrenamiento');
    }
};
