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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key linking to `users` table
            $table->integer('amount'); // Transaction amount
            $table->decimal('gst', 8, 2)->nullable(); // GST amount
            $table->decimal('tds', 8, 2)->nullable(); // TDS amount
            $table->decimal('final_amount', 10, 2)->nullable()->comment('Final amount after GST and TDS deductions');
            $table->string('transaction_id', 255)->nullable(); // Unique transaction identifier
            $table->string('status', 255)->default('completed'); // Transaction status (default: completed)
            $table->timestamps(); // Adds `created_at` and `updated_at` fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
