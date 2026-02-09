@extends('frontend.layouts.customer-dash')

@section('content')
<style>
    .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Property Section */
        .property-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 40px;
            border-bottom: 2px solid #e5e7eb;
        }

        .property-image {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            height: 400px;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .property-image .badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #2563eb;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .property-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .property-details h2 {
            color: #1e3a8a;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .property-location {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .property-location::before {
            content: "📍";
            font-size: 18px;
        }

        .property-info {
            background: #f0f9ff;
            padding: 24px;
            border-radius: 12px;
            border-left: 4px solid #2563eb;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0f2fe;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            color: #1e3a8a;
            font-size: 14px;
        }
        .info-row-location{
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            gap:35px;
            text-align: right;
            border-bottom: 1px solid #e0f2fe;
        }

        /* Form Section */
        .form-section {
            padding: 40px;
        }

        .section-title {
            color: #1e3a8a;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 3px solid #2563eb;
            display: inline-block;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        label .required {
            color: #dc2626;
        }

        input, select {
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        input::placeholder {
            color: #9ca3af;
        }

        /* Submit Button */
        .submit-section {
            display: flex;
            justify-content: center;
            padding: 30px 40px;
            background: #f9fafb;
            border-top: 2px solid #e5e7eb;
        }

        .submit-btn {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            padding: 16px 60px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }
    </style>
<div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Property Booking Form</h1>
            <p>Complete your property financing application</p>
        </div>

        <!-- Property Section -->
        <div class="property-section">
            <!-- Property Image -->
            <div class="property-image">
                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&h=600&fit=crop" alt="Godrej Skyline Koregaon Park">
                <div class="badge">Featured Property</div>
            </div>

            <!-- Property Details -->
            <div class="property-details">
                <h2>{{ $property->title}}</h2>
                <p class="property-location">Pune | {{ $property->select_bhk}}</p>
                
                <div class="property-info">
                    <div class="info-row">
                        <span class="info-label">Property Type</span>
                        <span class="info-value">{{ $property->land_type }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Configuration</span>
                        <span class="info-value">{{ $property->select_bhk }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Developer</span>
                        <span class="info-value">{{ $property->builder_name }}</span>
                    </div>
                    <div class="info-row-location">
                        <span class="info-label">Location</span>
                        <span class="info-value">{{ $property->address }}</span>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Customer Details Form -->
        <div class="form-section">
            <h3 class="section-title">Customer Details</h3>
                <form id="bookingForm" method="POST" action="{{ route('customer.property.book.submit') }}">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->properties_id }}">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="customerName">Full Name <span class="required">*</span></label>
                        <input type="text" id="customerName" name="customer_name" value="{{ $customer->name }}" placeholder="Enter full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customerEmail">Email Address <span class="required">*</span></label>
                        <input type="email" id="customerEmail" name="customer_email" value="{{ $customer->email }}" placeholder="Enter email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customerMobile">Mobile Number <span class="required">*</span></label>
                        <input type="tel" id="customerMobile" name="customer_mobile" value="{{ $customer->mobile }}" placeholder="Enter 10-digit mobile number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customerPan">PAN Number</label>
                        <input type="text" id="customerPan" name="customer_pan" value="{{ $customer->pan_no }}" placeholder="Enter PAN (Optional)" maxlength="10">
                    </div>
                </div>

                <!-- Co-Applicant Details -->
                <h3 class="section-title">Co-Applicant Details (Optional)</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="coApplicantName">Full Name</label>
                        <input type="text" id="coApplicantName" name="co_name" placeholder="Enter full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantEmail">Email Address</label>
                        <input type="email" id="coApplicantEmail" name="co_email" placeholder="Enter email address">
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantMobile">Mobile Number</label>
                        <input type="tel" id="coApplicantMobile" name="co_mobile" placeholder="Enter 10-digit mobile number">
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantEmployment">Employment Type</label>
                        <select id="coApplicantEmployment" name="co_employment_type">
                            <option value="">Select Employment Type</option>
                            <option value="salaried">Salaried</option>
                            <option value="self-employed">Self Employed</option>
                            <option value="business">Business Owner</option>
                            <option value="professional">Professional</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantDesignation">Designation</label>
                        <input type="text" id="coApplicantDesignation" name="co_designation" placeholder="Enter designation">
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantGender">Gender</label>
                        <select id="coApplicantGender" name="co_gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="coApplicantMaritalStatus">Marital Status</label>
                        <select id="coApplicantMaritalStatus" name="co_marital_status">
                            <option value="">Select Marital Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                </div>
                <!-- Submit Section -->
        <div class="submit-section">
            <button type="submit" class="submit-btn">Submit Booking</button>
        </div>
            </form>
        </div>

        
    </div>


<!-- <h3>Property Booking Form</h3>

<form method="POST" action="{{ route('customer.property.book.submit') }}">
@csrf

<input type="hidden" name="property_id" value="{{ $property->properties_id }}">

<h4>Customer Details</h4>

<input type="text" name="customer_name"
       value="{{ $customer->name }}" required placeholder="Name"><br><br>

<input type="email" name="customer_email"
       value="{{ $customer->email_id }}" required placeholder="Email"><br><br>

<input type="text" name="customer_mobile"
       value="{{ $customer->mobile_no }}" required placeholder="Mobile"><br><br>

<input type="text" name="customer_pan"
       value="{{ $customer->pan_no }}" placeholder="PAN (Optional)"><br><br>

<hr>

<h4>Property</h4>
<p><strong>{{ $property->title }}</strong></p>
<p>{{ $property->city }} | {{ $property->select_bhk }}</p>

<hr>

<h4>Co-Applicant (Optional)</h4>

<input type="text" name="co_name" placeholder="Name"><br><br>
<input type="email" name="co_email" placeholder="Email"><br><br>
<input type="text" name="co_mobile" placeholder="Mobile"><br><br>

<select name="co_employment_type">
    <option value="">Employment Type</option>
    <option value="salaried">Salaried</option>
    <option value="self_employed">Self Employed</option>
</select><br><br>

<input type="text" name="co_designation" placeholder="Designation"><br><br>

<select name="co_gender">
    <option value="">Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
</select><br><br>

<select name="co_marital_status">
    <option value="">Marital Status</option>
    <option value="single">Single</option>
    <option value="married">Married</option>
</select><br><br>

<button type="submit"
        style="padding:10px 20px;background:#000;color:#fff;border:none;">
    Submit Booking
</button>

</form> -->

@endsection
