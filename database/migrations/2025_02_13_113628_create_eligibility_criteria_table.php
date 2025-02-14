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
        Schema::create('eligibility_criteria', function (Blueprint $table) {
            $table->id('ec_id'); // Primary key
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key for users
            $table->unsignedBigInteger('loan_id')->nullable(); // Foreign key for loans
            
            // Income sources
            $table->text('rental_income_json')->nullable();
            $table->integer('rental_income_amount')->nullable();
            $table->text('coapplicant_rent_income_json')->nullable();
            $table->float('coapplicant_rent_income_amount')->nullable();
            $table->text('income_from_business_json')->nullable();
            $table->integer('income_from_business_amount')->nullable();
            $table->text('remunration_income_json')->nullable();
            $table->integer('remunration_income_amount')->nullable();
            $table->text('coapplicant_remunration_income_json')->nullable();
            $table->float('coapplicant_remunration_income_amount')->nullable();
            $table->text('Salary_from_firm_json')->nullable();
            $table->integer('Salary_from_firm_amount')->nullable();
            $table->float('coapplicant_salary')->nullable();
            $table->text('firm_share_profit_json')->nullable();
            $table->integer('firm_share_profit_amount')->nullable();
            $table->text('capital_interest_income_json')->nullable();
            $table->integer('capital_interest_income_amount')->nullable();
            $table->text('depreciation_json')->nullable();
            $table->integer('depreciation_amount')->nullable();
            $table->text('income_json')->nullable();
            $table->integer('income_amount')->nullable();
            $table->text('all_exiting_emi_json')->nullable();
            $table->integer('all_exiting_emi_amount')->nullable();
            $table->text('agriculture_income_json')->nullable();
            $table->float('agriculture_income_amount')->nullable();
            $table->text('deduction_json')->nullable();
            $table->float('deduction_amount')->nullable();

            // Tax and deductions
            $table->float('tax_amount')->nullable();
            $table->float('pf_amount')->nullable();
            $table->float('pt_amount')->nullable();

            // Loan-related values
            $table->float('proposed_emi'); // Required field

            // Timestamps
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility_criteria');
    }
};
