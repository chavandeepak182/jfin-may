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
        Schema::create('existing_loan', function (Blueprint $table) {
            $table->id('existing_loan_id'); // Primary key
            $table->string('type_loan', 255)->nullable();
            $table->integer('loan_amount')->nullable();
            $table->integer('tenure_loan')->nullable();
            $table->integer('emi_amount')->nullable();
            $table->date('sanction_date')->nullable();
            $table->integer('emi_bounce_count')->nullable();
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->timestamps(); // Automatically adds created_at & updated_at

            // Add foreign key constraint (assuming a users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('existing_loan');
    }
};
