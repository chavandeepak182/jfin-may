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
        Schema::create('education_details', function (Blueprint $table) {
            $table->id('edu_id'); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->string('qualification', 255)->nullable(); // Qualification
            $table->string('college_name', 255)->nullable(); // College Name
            $table->year('pass_year')->nullable(); // Passing Year
            $table->string('college_address', 255)->nullable(); // College Address
            $table->timestamp('created_at')->default(now()); // Default current timestamp
            $table->timestamp('updated_at')->default(now())->useCurrentOnUpdate(); // Auto-updates on changes

            // Foreign key constraint (if 'users' table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_details');
    }
};
