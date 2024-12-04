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
        Schema::create('animal_temporal_opcion_entregas', function (Blueprint $table) {
            $table->foreignId('animal_temporal_id')->constrained()->onDelete('cascade');
            $table->foreignId('opcion_entrega_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['animal_temporal_id', 'opcion_entrega_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_temporal_opcion_entregas');
    }
};
