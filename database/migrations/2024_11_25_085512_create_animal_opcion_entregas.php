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
        Schema::create('animal_opcion_entregas', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained();
            $table->foreignId('opcion_entrega_id')->constrained();
            $table->timestamps();
            $table->primary(['animal_id', 'opcion_entrega_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_opcion_entregas');
    }
};