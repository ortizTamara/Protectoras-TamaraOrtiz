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
        Schema::create('animal_temporal_comportamientos', function (Blueprint $table) {
            $table->foreignId('animal_temporal_id')->constrained()->onDelete('cascade');
            $table->foreignId('comportamiento_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['animal_temporal_id', 'comportamiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_temporal_comportamientos');
    }
};
