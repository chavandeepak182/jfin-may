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
        Schema::create('area_type', function (Blueprint $table) {
            $table->id('area_type_id'); // Primary key
            $table->string('carpet_area')->nullable(); // Nullable VARCHAR(255)
            $table->string('develop_area')->nullable(); // Nullable VARCHAR(255)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_type');
    }
};
