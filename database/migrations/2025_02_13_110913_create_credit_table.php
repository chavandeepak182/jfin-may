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
        Schema::create('credit', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedTinyInteger('credit_score')->nullable(); // 3-digit credit score
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key reference
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint (if 'users' table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit');
    }
};
