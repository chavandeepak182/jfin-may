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
        Schema::create('loan_category', function (Blueprint $table) {
            $table->id('loan_category_id'); // Auto-incrementing primary key
            $table->string('category_name', 255)->unique(); // Unique loan category names
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_category');
    }
};
