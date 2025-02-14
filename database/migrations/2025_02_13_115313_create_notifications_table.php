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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('sender_id'); // ID of the sender
            $table->unsignedBigInteger('receiver_id'); // ID of the receiver
            $table->text('message'); // Notification message
            $table->boolean('is_read')->default(false); // Read status (0 = unread, 1 = read)
            $table->timestamps(); // Created_at and Updated_at columns

            // Foreign key constraints (optional)
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
