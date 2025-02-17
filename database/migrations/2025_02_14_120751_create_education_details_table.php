<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('education_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('qualification');
            $table->string('college_name');
            $table->integer('passing_year');
            $table->string('college_address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_details');
    }
};

