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
        Schema::create('mis', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name'); // Name field
            $table->string('email'); // Email field
            $table->string('contact'); // Contact number
            $table->string('office_contact')->nullable(); // Office contact (optional)
            $table->string('product_type'); // Product type
            $table->string('occupation')->nullable(); // Occupation (optional)
            $table->decimal('amount', 10, 2); // Amount with precision
            $table->text('address'); // Address
            $table->string('city'); // City
            $table->string('office_address')->nullable(); // Office address (optional)
            $table->string('bank_name'); // Bank name
            $table->string('branch_name')->nullable(); // Branch name (optional)
            $table->timestamps(); // Created_at and Updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis');
    }
};
