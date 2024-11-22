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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_nacimiento');
            $table->unsignedSmallInteger('peso');
            $table->string('imagen')->nullable();
            // $table->foreignId('color_id')->constrained();
            // $table->foreignId('especie_id')->constrained();
            // $table->foreignId('raza_id')->constrained();
            $table->foreignId('color_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('especie_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('raza_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('protectora_id')->nullable()->constrained()->onDelete('set null'); //OnDelete, por si se borra la protectora, este se vuelva null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
