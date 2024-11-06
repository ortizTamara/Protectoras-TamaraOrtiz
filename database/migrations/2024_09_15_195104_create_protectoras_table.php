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
            $table->string('numero_registro_oficial');
            $table->integer('capacidad_alojamiento');
            $table->text('proceso_adopcion');
            $table->foreignId('provincia_id')->constrained();
            $table->string('direccion');
            $table->string('telefono_contacto');
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
