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
        Schema::create('commission', function (Blueprint $table) {
            $table->id('com_id'); // Primary key (auto-increment)
            $table->float('commission_amount')->nullable(); // Commission amount (nullable)
            $table->timestamp('created_date')->default(now()); // Default current timestamp
            $table->timestamp('updated_date')->default(now())->useCurrentOnUpdate(); // Update on change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission');
    }
};
