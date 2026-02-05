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
        Schema::create('historico_ciclista', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->date('fecha');
            $table->decimal('peso', 5, 2);
            $table->integer('ftp')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('pulso_reposo')->nullable();
            $table->integer('potencia_max')->nullable();
            $table->decimal('grasa_corporal', 4, 2)->nullable();
            $table->decimal('vo2max', 4, 1)->nullable();
            $table->string('comentario', '255')->nullable();

            $table->unique(['id_ciclista', 'fecha'], 'uq_ciclista_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_ciclista');
    }
};
