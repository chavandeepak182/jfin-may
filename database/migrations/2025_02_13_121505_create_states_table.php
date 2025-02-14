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
        Schema::create('states', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name', 50)->unique(); // State name (unique)
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade'); // Foreign key linking to `countries` table
            $table->timestamps(); // Adds `created_at` and `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
