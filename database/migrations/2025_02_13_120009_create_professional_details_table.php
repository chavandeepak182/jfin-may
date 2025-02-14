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
        Schema::create('professional_details', function (Blueprint $table) {
            $table->id('professional_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->string('profession_type')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('experience_year')->nullable();
            $table->string('company_address')->nullable();
            $table->string('industry')->nullable();
            $table->string('designation')->nullable();
            $table->decimal('netsalary', 15, 2)->nullable();
            $table->decimal('gross_salary', 15, 2)->nullable();
            $table->date('business_establish_date')->nullable();
            $table->decimal('selfincome', 15, 2)->nullable();
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_details');
    }
};
