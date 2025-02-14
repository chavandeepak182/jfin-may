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
        Schema::create('credit_scores', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->integer('credit_score')->nullable(); // Matches int(11) DEFAULT NULL
            $table->longText('report_data')->nullable(); // Matches longtext DEFAULT NULL
            $table->timestamp('fetched_at')->default(now()); // Matches timestamp DEFAULT current_timestamp()

            // Foreign key constraint (if 'users' table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_scores');
    }
};
