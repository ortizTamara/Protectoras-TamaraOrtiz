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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->foreignId('genero_id')->constrained();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('numero_telefono');
            $table->foreignId('pais_id')->constrained();
            $table->foreignId('comunidad_autonoma_id')->constrained();
            $table->foreignId('provincia_id')->constrained();
            $table->string('codigo_postal');
            $table->foreignId('rol_id')->constrained();
            // $table->foreignId('rol_id')->default(2)->constrained(); //Por defecto 2 que es el usuario, 1 sería el Administrador y 3 ayudante (Esta es otra forma de hacerlo, pero hay que asegurarse que el ID no cambia)
            // Por defecto null, a no ser que el usuario se registre como Protectora y también si el Usuario recibe el rol de Ayudante.
            $table->foreignId('protectora_id')->nullable()->constrained()->onDelete('set null'); //OnDelete, por si se borra la protectora, este se vuelva null
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
