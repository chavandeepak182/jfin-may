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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->string('name', 255); // Matches varchar(255) NOT NULL
            $table->decimal(15, 2); // Matches decimal(15,2) NOT NULL
            $table->timestamp('created_at')->default(now()); // Matches timestamp DEFAULT current_timestamp()
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
        Schema::dropIfExists('deductions');
    }
};
