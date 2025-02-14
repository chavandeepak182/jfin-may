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
        Schema::create('company_bank_details', function (Blueprint $table) {
            $table->id('bank_id'); // Primary key (auto-increment)
            $table->string('acc_name', 45)->nullable(); // Account holder name
            $table->bigInteger('acc_number')->nullable(); // Account number
            $table->string('ifsc_code', 45)->nullable(); // IFSC Code
            $table->string('bank_name', 45)->nullable(); // Bank Name
            $table->string('branch_name', 45)->nullable(); // Branch Name
            $table->string('gst_number', 45)->nullable(); // GST Number
            $table->string('pan_number', 45)->nullable(); // PAN Number
            $table->string('manager_name', 255)->nullable(); // Manager Name
            $table->string('manager_number', 20)->nullable(); // Manager Contact Number
            $table->string('bank_address', 255)->nullable(); // Bank Address
            $table->timestamp('created_at')->default(now()); // Default current timestamp
            $table->timestamp('updated_at')->default(now())->useCurrentOnUpdate(); // Update on change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_bank_details');
    }
};
