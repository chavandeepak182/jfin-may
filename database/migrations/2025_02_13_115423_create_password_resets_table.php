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
        Schema::create('password_resets', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('email')->index(); // User email (indexed for fast lookups)
            $table->string('token'); // Reset token
            $table->dateTime('exp_date'); // Token expiration date
            $table->unsignedBigInteger('user_id'); // Reference to users table
            $table->timestamps(); // Created_at and Updated_at columns

            // Foreign key constraint (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
};
