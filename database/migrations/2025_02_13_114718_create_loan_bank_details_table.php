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
        Schema::create('loan_bank_details', function (Blueprint $table) {
            $table->id('bank_id'); // Primary Key
            $table->string('acc_name', 45)->nullable();
            $table->bigInteger('acc_number')->nullable(); // Changed to BigInteger for larger account numbers
            $table->string('ifsc_code', 45)->nullable();
            $table->string('bank_name', 45)->nullable();
            $table->string('branch_name', 45)->nullable();
            $table->string('gst_number', 45)->nullable();
            $table->string('pan_number', 45)->nullable();
            $table->string('manager_name', 255)->nullable();
            $table->string('manager_number', 20)->nullable();
            $table->string('bank_address', 255)->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_bank_details');
    }
};
