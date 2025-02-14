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
        Schema::create('leads', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 20);
            $table->string('alternate_phone', 20)->nullable();
            $table->enum('lead_source', ['Website', 'Referral', 'Social Media', 'Walk-in', 'Call', 'Agent']);
            $table->string('campaign_name', 255)->nullable();
            $table->dateTime('inquiry_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('property_type', ['Apartment', 'Villa', 'Commercial', 'Land', 'Office']);
            $table->decimal('budget_min', 12, 2);
            $table->decimal('budget_max', 12, 2);
            $table->string('location_preference', 255);
            $table->enum('possession_time', ['Ready To Move', '3 Months', '6 Months', '1 Year', 'Ongoing']);
            $table->enum('property_status', ['New', 'Resale', 'Under Construction']);
            $table->enum('lead_status', ['New', 'Contacted', 'Interested', 'Not Interested', 'Closed', 'Converted']);
            $table->date('follow_up_date')->nullable();
            $table->integer('lead_score');
            $table->unsignedBigInteger('assigned_to');
            $table->text('notes')->nullable();
            $table->enum('lead_type', ['Buyer', 'Seller', 'Investor', 'Tenant', 'Landlord']);
            $table->enum('financing_status', ['Pre-Approved', 'Loan Needed', 'Self-Financed']);
            $table->string('loan_provider', 255)->nullable();
            $table->date('closing_date')->nullable();
            $table->timestamps(); // Automatically adds created_at & updated_at

            // Foreign Key Constraint (assuming 'assigned_to' references 'users' table)
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
