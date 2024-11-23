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
        Schema::create('rechazados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('numero_registro_oficial')->unique();
            $table->integer('capacidad_alojamiento');
            $table->text('nuestra_historia');
            $table->string('direccion');
            $table->string('telefono_contacto');
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('web')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('esValido')->default(false);
            $table->text('motivo_rechazo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rechazados');
    }
};
