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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('document_id'); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->string('document_name', 255); // Document name
            $table->string('file_path', 255); // File path
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
        Schema::dropIfExists('documents');
    }
};
