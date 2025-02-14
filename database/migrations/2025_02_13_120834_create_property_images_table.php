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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('properties_id'); // Foreign key reference
            $table->text('image_url'); // Stores image URL
            $table->boolean('is_featured')->default(0)->comment('1 = featured image, 0 = other');
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint
            $table->foreign('properties_id')->references('properties_id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
