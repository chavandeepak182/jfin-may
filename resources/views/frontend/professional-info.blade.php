@extends('frontend.layouts.header')
@section('title', "Apply for a Loan | Jfinserv")

@section('content')

<div class="container-fluid bg-white py-5">
    <div class="container">
        <div class="row g-5 align-items-start mb-5 pb-5">
            <!-- Progress Bar Section -->
            <div class="col-md-3">
                <div class="progress-steps p-4">
                    <h5 class="text-primary mb-3">Application Steps</h5>
                    <ul class="list-group">
                        <li class="list-group-item {{ $currentStep == 1 ? 'active' : '' }}">
                            <span>1. Personal Details</span>
                        </li>
                        <li class="list-group-item {{ $currentStep == 2 ? 'active' : '' }}">
                            <span>2. Professional Details</span>
                        </li>
                        <li class="list-group-item {{ $currentStep == 3 ? 'active' : '' }}">
                            <span>3. Qualification Details</span>
                        </li>
                        <!-- <li class="list-group-item {{ $currentStep == 4 ? 'active' : '' }}">
                            <span>4. Existing Loan Details</span>
                        </li> -->
                        <li class="list-group-item {{ $currentStep == 4 ? 'active' : '' }}">
                            <span>4. Upload Documents</span>
                        </li>
                        <li class="list-group-item {{ $currentStep == 5 ? 'active' : '' }}">
                            <span>5. Loan Details</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Form Section -->
            <div class="col-md-9">
                <div class="form-container shadow rounded bg-white p-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('loan.handle_step') }}" method="POST" enctype="multipart/form-data" role="form" autocomplete="off" class="form">
                        @csrf
                        <input type="hidden" name="current_step" value="{{ $currentStep }}">
                        <input type="hidden" name="is_loan" value="{{ $is_loan }}">
                        <input type="hidden" name="loan_category_id" value="{{ session('loan_category_id', '') }}">
                        <input type="hidden" name="bank_id" value="{{ session('bank_id', '') }}">

                        <!-- Personal Details -->
                        @if ($currentStep == 1)
                            <fieldset>
                                <h4 class="text-primary mb-3">Personal Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="loan_category_id" id="loan_category" class="form-control" required>
                                                <option value="">Select Loan Category</option>
                                                @foreach($loanCategories as $category)
                                                    <option value="{{ $category->loan_category_id }}" 
                                                        {{ old('loan_category_id', $loan->loan_category_id ?? '') == $category->loan_category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="loan_category">Loan Category <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="bank_id" id="bank_id" class="form-control" required>
                                                <option value="">Select Bank</option>
                                                @foreach($loanBanks as $bank)
                                                    <option value="{{ $bank->bank_id }}" 
                                                        {{ old('bank_id', $loan->bank_id ?? '') == $bank->bank_id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                            @error('bank_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>    

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="phone" name="mobile_no" 
                                                value="{{ old('mobile_no', $profile->mobile_no ?? '') }}" placeholder="Phone" required>
                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                            @error('mobile_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="dob" name="dob" 
                                                value="{{ old('dob', $profile->dob ?? '') }}" placeholder="DOB" required>
                                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                            @error('dob')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="marital_status" name="marital_status" required>
                                                <option value="" selected disabled hidden>Select Marital Status</option>
                                                <option value="Single" {{ old('marital_status', $profile->marital_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                                <option value="Married" {{ old('marital_status', $profile->marital_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                            </select>
                                            <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                                            @error('marital_status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="residence_address" name="residence_address" 
                                                value="{{ old('residence_address', $profile->residence_address ?? '') }}" placeholder="Address" required>
                                            <label for="residence_address">Address <span class="text-danger">*</span></label>
                                            @error('residence_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="state" name="state" required>
                                                <option value="">Select State <span class="text-danger">*</span></option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{ old('state', $profile->state ?? '') == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="state">State <span class="text-danger">*</span></label>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="city" name="city" required>
                                                <option value="">Select City</option>
                                                @if(isset($profile->city))
                                                    <option value="{{ $profile->city }}" selected>{{ optional(DB::table('cities')->where('id', $profile->city)->first())->city }}</option>
                                                @endif
                                            </select>
                                            <label for="city">City</label>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pincode" name="pincode" 
                                                value="{{ old('pincode', $profile->pincode ?? '') }}" placeholder="Pincode">
                                            <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                            @error('pincode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                        <!-- Professional Details -->
                        @elseif ($currentStep == 2)
                            <fieldset>
                                <h4 class="text-primary mb-3">Professional Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input profession_type" type="radio" name="profession_type" id="salariedTab" value="salaried" checked 
                                                {{ old('profession_type', $professional->profession_type ?? '') == 'salaried' ? 'checked' : '' }}>
                                            <label for="salariedTab">Salaried Employees</label>
                                        </div>
                                        <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input profession_type" type="radio" name="profession_type" id="selfTab" value="self" 
                                                {{ old('profession_type', $professional->profession_type ?? '') == 'self' ? 'checked' : '' }}>
                                            <label for="selfTab">Self Employed/ Business Professionals</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $professional->company_name ?? '') }}" placeholder="Company Name" required>
                                            <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                        </div>
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="industry" name="industry" value="{{ old('industry', $professional->industry ?? '') }}" placeholder="Industry" required>
                                            <label for="industry">Nature of Business <span class="text-danger">*</span></label>
                                        </div>
                                        @error('industry')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="company_address" name="company_address" value="{{ old('company_address', $professional->company_address ?? '') }}" placeholder="Company Address" required>
                                            <label for="company_address">Company Address <span class="text-danger">*</span></label>
                                        </div>
                                        @error('company_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="experience_year" name="experience_year" value="{{ old('experience_year', $professional->experience_year ?? '') }}" placeholder="Experience Year" required>
                                            <label for="experience_year">Experience Year <span class="text-danger">*</span></label>
                                        </div>
                                        @error('experience_year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $professional->designation ?? '') }}" placeholder="Designation" required>
                                            <label for="designation">Designation <span class="text-danger">*</span></label>
                                        </div>
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6" id="netsalary">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="netsalary" name="netsalary" value="{{ old('netsalary', $professional->netsalary ?? '') }}" placeholder="Net Salary" required>
                                            <label for="netsalary">Net Salary <span class="text-danger">*</span></label>
                                        </div>
                                        @error('netsalary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6" id="gross_salary">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="gross_salary" name="gross_salary" value="{{ old('gross_salary', $professional->gross_salary ?? '') }}" placeholder="Gross Salary" required>
                                            <label for="gross_salary">Gross Salary <span class="text-danger">*</span></label>
                                        </div>
                                        @error('gross_salary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating" id="selfincome">
                                            <input type="number" class="form-control" id="selfincome" name="selfincome" value="{{ old('selfincome', $professional->selfincome ?? '') }}" placeholder="Total Income">
                                            <label for="selfincome">Total Income <span class="text-danger">*</span></label>
                                        </div>
                                        @error('selfincome')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating" id="business_establish_date">
                                            <input type="date" class="form-control" id="business_establish_date" name="business_establish_date" 
                                                value="{{ old('business_establish_date', isset($professional->business_establish_date) ? \Carbon\Carbon::parse($professional->business_establish_date)->format('Y-m-d') : '') }}" 
                                                placeholder="Business Establish Date">
                                            <label for="business_establish_date">Business Establish Date <span class="text-danger">*</span></label>
                                        </div>
                                        @error('business_establish_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </fieldset>

                        <!-- Qualification Details -->
                        @elseif ($currentStep == 3)
                            <fieldset>
                                <h4 class="text-primary mb-3">Qualification Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="qualification" name="qualification" value="{{ old('qualification', $education->qualification ?? '') }}" placeholder="Qualification" required>
                                            <label for="qualification">Highest Degree</label>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="pass_year" name="pass_year" value="{{ old('pass_year', $education->pass_year ?? '') }}" placeholder="pass_year" required>
                                            <label for="pass_year">Pass Year</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="college_name" name="college_name" value="{{ old('college_name', $education->college_name ?? '') }}" placeholder="College Name" required>
                                            <label for="college_name">College Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="college_address" name="college_address" value="{{ old('college_address', $education->college_address ?? '') }}" placeholder="College Address" required>
                                            <label for="college_address">College Address</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        <!-- Upload Documents -->
                        @elseif ($currentStep == 4)
                            <fieldset>
                                <h4 class="text-primary">Upload Documents</h4>
                                <div class="row g-3">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    ID Proof
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body rounded">
                                                    <div class="row g-3">
                                                        @foreach (['aadhar_card', 'pancard', 'passport'] as $docType)
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                                    <label for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>
                                                                    @php
                                                                        $existingDoc = $documents->firstWhere('document_name', $docType);
                                                                    @endphp
                                                                    @if($existingDoc)
                                                                        <a href="{{ Storage::url($existingDoc->file_path) }}" target="_blank">View Uploaded {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Residence Proof
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body rounded">
                                                    <div class="row g-3">
                                                        @foreach (['light_bill', 'dl', 'rent_agree'] as $docType)
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                                    <label for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>
                                                                    @php
                                                                        $existingDoc = $documents->firstWhere('document_name', $docType);
                                                                    @endphp
                                                                    @if($existingDoc)
                                                                        <a href="{{ Storage::url($existingDoc->file_path) }}" target="_blank">View Uploaded {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Income Proof
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                        @foreach (['salary_slip', 'form_16'] as $docType)
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                                    <label for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>
                                                                    @php
                                                                        $existingDoc = $documents->firstWhere('document_name', $docType);
                                                                    @endphp
                                                                    @if($existingDoc)
                                                                        <a href="{{ Storage::url($existingDoc->file_path) }}" target="_blank">View Uploaded {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    Other Documents
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                        @foreach (['bank_statement', 'qualification_proof'] as $docType)
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                                    <label for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>
                                                                    @php
                                                                        $existingDoc = $documents->firstWhere('document_name', $docType);
                                                                    @endphp
                                                                    @if($existingDoc)
                                                                        <a href="{{ Storage::url($existingDoc->file_path) }}" target="_blank">View Uploaded {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        <!-- Loan Details -->
                        @elseif ($currentStep == 5)
                            <fieldset>
                                <h4 class="text-primary mb-3">Loan Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" step="0.01" name="amount" value="{{ old('amount', $loan->amount ?? '') }}" class="form-control" id="amount" placeholder="Amount" required>
                                            <label for="amount">Loan Amount</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="tenure" id="tenure" class="form-control" required>
                                            <!-- <select name="tenure" class="form-select form-control border-0" id="tenure" required> -->
                                                <option value="">Select Tenure</option>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}" {{ old('tenure', $loan->tenure ?? '') == $i ? 'selected' : '' }}>{{ $i }} year{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>
                                            <label for="tenure">Tenure (in years)</label>
                                        </div>
                                    </div>

                                    <!-- Referral Code Input -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="referral_code" value="{{ old('referral_code') }}" class="form-control" id="referral_code" placeholder="Referral Code">
                                            <label for="referral_code">Referral Code (Optional)</label>
                                        </div>
                                    </div>

                                    <!-- Promo Code Input -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="pan_number" value="{{ old('pan_number', $loan->pan_number ?? '') }}" class="form-control" id="pan_number" placeholder="PAN Number">
                                            <label for="pan_number">PAN Number</label>
                                        </div>
                                    </div>

                                    <!-- Button and Feedback Section -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <button type="button" id="check-referral-code" class="btn btn-primary">Check Code</button>
                                        </div>
                                        <div id="referral-feedback" class="col-md-12 mt-3"></div>
                                    </div>
                            </fieldset>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                @if ($currentStep > 1)
                                    <button name="previous" class="btn btn-outline-primary w-100 py-3" value="previous" type="submit">
                                        <i class="bi bi-arrow-left"></i> Previous
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button name="next" class="btn btn-primary w-100 py-3" value="next" type="submit">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Progress Bar Styling */
    .progress-steps .list-group-item {
        border: none;
        font-size: 16px;
        font-weight: 500;
        padding: 10px 15px;
        color: #333;
        margin-bottom: 15px;
    }

    .progress-steps .list-group-item.active {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        border-radius: 0;
    }

    /* Form Styling */
    .form-container {
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    legend {
        font-size: 20px;
        font-weight: bold;
        color: #007bff;
    }

    .btn-outline-primary {
        border: 2px solid #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<script>
   document.getElementById('state').addEventListener('change', function () {
    const stateId = this.value;
    const citySelect = document.getElementById('city');
    citySelect.innerHTML = '<option value="">Select City</option>';  // Reset options

    if (stateId) {
        fetch(`/cities/${stateId}`)
            .then(response => response.json())
            .then(cities => {
                if (cities.length > 0) {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;  // ID of city
                        option.textContent = city.city;  // Name of city
                        citySelect.appendChild(option);
                    });
                } else {
                    citySelect.innerHTML = '<option value="">No cities available</option>';
                }
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
});
</script>
<script>
    // Initialize loan index based on the count of existing loans
    let loanIndex = {{ count($existingLoans) ?? 0 }}; // Start from the number of existing loans

    // Function to add a new loan entry dynamically
    function addLoanEntry() {
        const loanContainer = document.getElementById('existing-loans-container');

        // Create HTML for the new loan entry
        const newLoanHTML = `
            <div class="existing-loan-entry mb-3" id="existing-loan-${loanIndex}">
                <div class="row g-3">
                    <!-- Type of Loan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="type_loan[]" class="form-control" placeholder="Type of Loan">
                            <label>Type of Loan</label>
                        </div>
                    </div>

                    <!-- Loan Amount -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" step="0.01" name="loan_amount[]" class="form-control" placeholder="Loan Amount">
                            <label>Loan Amount</label>
                        </div>
                    </div>

                    <!-- Tenure of Loan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="tenure_loan[]" class="form-control" placeholder="Tenure of Loan (in months)">
                            <label>Tenure of Loan (in months)</label>
                        </div>
                    </div>

                    <!-- EMI Amount -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" step="0.01" name="emi_amount[]" class="form-control" placeholder="EMI Amount">
                            <label>EMI Amount</label>
                        </div>
                    </div>

                    <!-- Sanction Date -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="sanction_date[]" class="form-control">
                            <label>Sanction Date</label>
                        </div>
                    </div>

                    <!-- EMI Bounce Count -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="emi_bounce_count[]" class="form-control" placeholder="EMI Bounce Count">
                            <label>EMI Bounce Count</label>
                        </div>
                    </div>

                    <!-- Remove Button -->
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger" onclick="removeLoanEntry(${loanIndex})">Remove Loan</button>
                    </div>
                </div>
            </div>
        `;

        // Append the new loan HTML to the container
        loanContainer.insertAdjacentHTML('beforeend', newLoanHTML);

        // Increment the loan index for the next entry
        loanIndex++;
    }

    // Function to remove a loan entry dynamically
    function removeLoanEntry(index) {
        const loanEntry = document.getElementById('existing-loan-' + index);
        if (loanEntry) {
            loanEntry.remove();
        }

        // Optionally, you can update the loan index to re-adjust the index values if needed.
        // Example: Loop through remaining entries and re-index them
        const remainingLoans = document.querySelectorAll('.existing-loan-entry');
        loanIndex = remainingLoans.length;
    }

    // Function to validate and clean empty loan entries before form submission
    function cleanEmptyLoanEntries() {
        const loanEntries = document.querySelectorAll('.existing-loan-entry');
        loanEntries.forEach(entry => {
            const typeLoan = entry.querySelector('input[name="type_loan[]"]').value.trim();
            const loanAmount = entry.querySelector('input[name="loan_amount[]"]').value.trim();
            const tenureLoan = entry.querySelector('input[name="tenure_loan[]"]').value.trim();
            const emiAmount = entry.querySelector('input[name="emi_amount[]"]').value.trim();
            const sanctionDate = entry.querySelector('input[name="sanction_date[]"]').value.trim();
            const emiBounceCount = entry.querySelector('input[name="emi_bounce_count[]"]').value.trim();

            // Remove entry if all fields are empty
            if (!typeLoan && !loanAmount && !tenureLoan && !emiAmount && !sanctionDate && !emiBounceCount) {
                entry.remove(); // Remove this empty entry from the DOM
            }
        });
    }

    // Attach this function to your form submission event
    document.getElementById('your-form-id').addEventListener('submit', function(event) {
        cleanEmptyLoanEntries(); // Clean empty loan entries before submitting the form
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const salariedTab = document.getElementById('salariedTab');
    const selfTab = document.getElementById('selfTab');
    const businessEstablishDate = document.getElementById('business_establish_date').closest('.col-md-6');
    const selfIncome = document.getElementById('selfincome').closest('.col-md-6');
    const netSalary = document.getElementById('netsalary').closest('.col-md-6');
    const grossSalary = document.getElementById('gross_salary').closest('.col-md-6');

    function toggleTextField() {
        if (selfTab.checked) {
            businessEstablishDate.classList.remove('d-none');
            selfIncome.classList.remove('d-none');
            netSalary.classList.add('d-none');
            grossSalary.classList.add('d-none');
        } else {
            businessEstablishDate.classList.add('d-none');
            selfIncome.classList.add('d-none');
            netSalary.classList.remove('d-none');
            grossSalary.classList.remove('d-none');
        }
    }

    salariedTab.addEventListener('change', toggleTextField);
    selfTab.addEventListener('change', toggleTextField);

    toggleTextField(); // Ensure correct fields are visible on page load
});

</script>

<script>
    document.getElementById('check-referral-code').addEventListener('click', function () {
    const referralCode = document.getElementById('referral_code').value;

    if (referralCode.trim() === '') {
        alert('Please enter a referral code.');
        return;
    }

    fetch('{{ route('check.referral_code') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ referral_code: referralCode })
    })
    .then(response => response.json())
    .then(data => {
        const feedbackElement = document.getElementById('referral-feedback');
        if (data.success) {
            // Show success message along with the user's name
            feedbackElement.innerHTML = `<div class="alert alert-success">${data.message} Referred by: ${data.user_name}</div>`;
        } else {
            // Show error message
            feedbackElement.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('referral-feedback').innerHTML = '<div class="alert alert-danger">An error occurred while checking the referral code.</div>';
    });
});
</script>

@endsection
