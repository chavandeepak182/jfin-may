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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id('enquiry_id'); // Primary key
            $table->string('name')->nullable();
            $table->string('email', 45)->nullable();
            $table->string('contact', 255)->nullable();
            $table->string('amount', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('enquiry_type', 255)->nullable();
            $table->string('message', 255)->nullable();
            $table->timestamps(); // Automatically adds created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
