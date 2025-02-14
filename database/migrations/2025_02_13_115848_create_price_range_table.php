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
        Schema::create('price_range', function (Blueprint $table) {
            $table->id('range_id'); // Primary Key
            $table->bigInteger('from_price')->unsigned(); // Start of Price Range
            $table->bigInteger('to_price')->unsigned(); // End of Price Range
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_range');
    }
};
