<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id');
            $table->string('loan_reference_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('interest', 5, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'disbursed'])->default('pending');
            $table->integer('tenure');
            $table->string('kyc_status')->nullable();
            $table->string('address_verification')->nullable();
            $table->integer('cibil_score')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('loan_category_id');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};