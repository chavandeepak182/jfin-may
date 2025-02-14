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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (bigint unsigned)
            $table->string('name', 255); // Category name
            $table->unsignedInteger('_lft')->default(0); // Left boundary for nested set
            $table->unsignedInteger('_rgt')->default(0); // Right boundary for nested set
            $table->unsignedInteger('parent_id')->nullable(); // Parent category reference
            $table->timestamps(); // created_at & updated_at
            $table->integer('user_id')->nullable(); // User ID (nullable)
            
            // Foreign key constraint (if user table exists)
            // Uncomment if 'users' table is present
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
