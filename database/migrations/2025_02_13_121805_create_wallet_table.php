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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id('wallet_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->integer('wallet_balance')->default(0); // Default balance is 0
            $table->timestamps(); // Adds `created_at` and `updated_at` fields

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
