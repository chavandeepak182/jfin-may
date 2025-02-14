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
        Schema::create('profile', function (Blueprint $table) {
            $table->id('profile_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->string('mobile_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->text('residence_address')->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->integer('pincode')->nullable();
            $table->string('rera_doc')->nullable();
            $table->string('licence_doc')->nullable();
            $table->string('address_proof')->nullable();
            $table->softDeletes(); // deleted_at column for soft delete
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
