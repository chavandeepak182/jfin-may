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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name', 255); // User's full name
            $table->string('email_id', 255)->unique(); // Unique email
            $table->string('pan_no', 200)->nullable(); // PAN number (optional)
            $table->string('password'); // Encrypted password
            $table->unsignedBigInteger('wallet_id')->nullable(); // Foreign key to wallet table
            $table->unsignedBigInteger('existing_loan_id')->nullable(); // Foreign key to loans table
            $table->unsignedBigInteger('role_id')->nullable(); // Foreign key to roles table
            $table->unsignedBigInteger('profile_id')->nullable(); // Foreign key to profile table
            $table->unsignedBigInteger('edu_id')->nullable(); // Foreign key to education table
            $table->unsignedBigInteger('professional_id')->nullable(); // Foreign key to professional details table
            $table->text('referral_code')->nullable(); // Referral code (optional)
            $table->unsignedBigInteger('refer_user_id')->nullable(); // User ID of the person who referred this user
            $table->text('email_otp')->nullable(); // OTP for email verification
            $table->boolean('is_email_verify')->default(0)->comment('0 = not verified, 1 = verified'); // Email verification status
            $table->timestamps(); // Adds `created_at` and `updated_at`
            $table->softDeletes(); // Adds `deleted_at` for soft deletes

            // Foreign key constraints
            $table->foreign('wallet_id')->references('wallet_id')->on('wallet')->onDelete('set null');
            $table->foreign('existing_loan_id')->references('loan_id')->on('loans')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('set null');
            $table->foreign('edu_id')->references('edu_id')->on('education')->onDelete('set null');
            $table->foreign('professional_id')->references('professional_id')->on('professional_details')->onDelete('set null');
            $table->foreign('refer_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
