<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('professional_details', function (Blueprint $table) {
            $table->id('professional_id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->string('industry');
            $table->string('company_address');
            $table->integer('experience_years');
            $table->string('designation');
            $table->decimal('net_salary', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professional_details');
    }
};
