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
        Schema::create('property_owner', function (Blueprint $table) {
            $table->id('owner_id'); // Auto-increment primary key
            $table->string('name', 45)->nullable(); // Owner's name
            $table->string('number', 15)->nullable(); // Contact number
            $table->string('email', 45)->nullable()->unique(); // Email (unique)
            $table->string('adhar_card', 45)->nullable(); // Aadhaar card number
            $table->string('pancard', 45)->nullable(); // PAN card number
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_owner');
    }
};
