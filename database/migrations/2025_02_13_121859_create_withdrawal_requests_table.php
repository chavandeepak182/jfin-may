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
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->integer('amount'); // Requested withdrawal amount
            $table->decimal('gst', 8, 2)->nullable(); // GST deduction
            $table->decimal('tds', 8, 2)->nullable(); // TDS deduction
            $table->decimal('final_amount', 8, 2)->nullable(); // Final amount after deductions
            $table->string('transaction_id')->nullable(); // Transaction ID (optional)
            $table->string('status')->default('pending'); // Default status is 'pending'
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
        Schema::dropIfExists('withdrawal_requests');
    }
};
