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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('sender_id'); // Sender's user ID
            $table->unsignedBigInteger('recipient_id'); // Recipient's user ID
            $table->string('subject', 255); // Message subject
            $table->text('message_body'); // Message content
            $table->boolean('is_read')->default(0); // Message read status
            $table->timestamps(); // Created_at and Updated_at columns

            // Foreign key constraints
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
