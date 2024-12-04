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
        Schema::create('animal_temporals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_nacimiento');
            $table->decimal('peso', 5, 2);
            $table->string('imagen')->nullable();
            $table->foreignId('genero_animal_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('nivel_actividad_id')->nullable()->constrained()->onDelete('set null');
            // $table->foreignId('color_id')->constrained();
            // $table->foreignId('especie_id')->constrained();
            // $table->foreignId('raza_id')->constrained();
            $table->foreignId('color_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('especie_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('raza_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('estado_animal_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('protectora_id')->nullable()->constrained()->onDelete('set null'); //set null, porque ya hago la logica en models protectora boot
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_temporals');
    }
};
