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
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id'); // Primary Key
            $table->string('loan_reference_id', 255)->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('is_broker')->nullable()->comment('broker applied loan with broker_user_id');
            $table->bigInteger('amount')->nullable();
            $table->integer('amount_approved')->nullable();
            $table->integer('interest')->nullable();
            $table->string('status', 255)->nullable()->comment('1=in process, 2=document pending, 3=approved, 4=rejected, 5=document submitted to bank');
            $table->integer('tenure')->nullable();
            $table->enum('kyc_status', ['not verified', 'verified'])->nullable();
            $table->string('sanction_letter', 255)->nullable();
            $table->enum('address_verification', ['not verified', 'verified'])->nullable();
            $table->integer('cibil_score')->nullable();
            $table->string('pan_number', 200)->nullable();
            $table->string('in_principle', 255)->nullable();
            $table->unsignedBigInteger('referral_user_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('loan_category_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('agent_action', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps(); // created_at & updated_at

            // Foreign Key Constraints
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('set null');
            $table->foreign('referral_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_category_id')->references('loan_category_id')->on('loan_category')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
