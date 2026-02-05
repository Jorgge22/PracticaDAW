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
        Schema::create('bicicleta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', '50');
            $table->enum('tipo', ['carretera', 'mtb', 'gravel', 'rodillo']);
            $table->string('comentario', '255')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bicicleta');
    }
};
