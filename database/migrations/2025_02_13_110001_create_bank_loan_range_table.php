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
        Schema::create('bank_loan_range', function (Blueprint $table) {
            $table->id('loan_range_id'); // Primary key
            $table->unsignedBigInteger('bank_id'); // Foreign key reference
            $table->integer('max_cibil'); // Max CIBIL score
            $table->integer('min_cibil'); // Min CIBIL score
            $table->integer('loan_amount'); // Loan amount
            $table->float('bank_interest'); // Bank interest rate
            $table->unsignedBigInteger('loan_category_id'); // Foreign key reference
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraints
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('loan_category_id')->references('loan_category_id')->on('loan_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_loan_range');
    }
};
