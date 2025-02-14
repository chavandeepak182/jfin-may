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
        Schema::create('properties', function (Blueprint $table) {
            $table->id('properties_id'); // Primary Key
            $table->string('title')->nullable();
            $table->unsignedBigInteger('property_type_id'); // Foreign Key
            $table->string('land_type')->nullable();
            $table->string('builder_name')->nullable();
            $table->text('rera')->nullable();
            $table->double('s_price')->nullable();
            $table->integer('select_bhk')->nullable();
            $table->text('image')->nullable();
            $table->string('property_details')->nullable();
            $table->text('boucher')->nullable();
            $table->string('address')->nullable();
            $table->string('facilities')->nullable();
            $table->integer('beds')->nullable();
            $table->integer('baths')->nullable();
            $table->integer('balconies')->nullable();
            $table->integer('parking')->nullable();
            $table->unsignedBigInteger('price_range_id')->nullable();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->text('contact')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(0)->comment('0 = not active, 1 = active');
            $table->text('area');
            $table->text('builtup_area')->nullable();
            $table->text('localities');
            $table->text('city');
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('nearby_locations')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
