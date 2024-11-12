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
        Schema::create('permiso_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained()->onDelete('cascade'); //Elimina registros relacionados si el rol se borra
            $table->foreignId('permiso_id')->constrained()->onDelete('cascade'); //elimina registros relacionados si el permiso se borra
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_roles');
    }
};
