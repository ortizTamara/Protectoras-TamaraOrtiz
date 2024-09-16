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
        Schema::create('protectoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('pais_id')->constrained();
            $table->foreignId('provincia_id')->constrained();
            $table->foreignId('comunidad_autonoma')->constrained();
            $table->string('codigo_postal');
            $table->string('direccion');
            $table->string('numero_telefono');
            $table->string('email')->unique();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protectoras');
    }
};
