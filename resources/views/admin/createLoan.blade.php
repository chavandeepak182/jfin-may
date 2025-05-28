@extends('layouts.header')
@section('title')

    @parent
    JFS | Activity Logs

@endsection
@section('content')


@section('content')
    @parent


    <style type="text/css">
        form fieldset {
            margin-left: 15px;
            margin-right: 15px;
            padding: 3% !important;
        }
    </style>
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Loan</li>
        </ol>
    </nav>

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/frontend/scss/bootstrap/scss/_accordion.scss">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/frontend/scss/bootstrap/scss/_variables.scss">


    <!-- export button -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <div style="padding: 1%">
        <h1>
            <center>Create Loan</center>
        </h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Loan</h6>
            </div>

            <form action="{{ route('admin.handle_step') }}" method="POST" enctype="multipart/form-data" role="form"
                autocomplete="off" class="form">
                @csrf

                <fieldset>
                    <h4 class="text-primary mb-3">Personal Details</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="loan_category_id" id="loan_category" class="form-control" required>
                                    <option value="">Select Loan Category</option>
                                    @foreach ($loanCategories as $category)
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
                                    @foreach ($loanBanks as $bank)
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
                                    <option value="Single"
                                        {{ old('marital_status', $profile->marital_status ?? '') == 'Single' ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="Married"
                                        {{ old('marital_status', $profile->marital_status ?? '') == 'Married' ? 'selected' : '' }}>
                                        Married</option>
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
                                    value="{{ old('residence_address', $profile->residence_address ?? '') }}"
                                    placeholder="Address" required>
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
                                        <option value="{{ $state->id }}"
                                            {{ old('state', $profile->state ?? '') == $state->id ? 'selected' : '' }}>
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
                                    @if (isset($profile->city))
                                        <option value="{{ $profile->city }}" selected>
                                            {{ optional(DB::table('cities')->where('id', $profile->city)->first())->city }}
                                        </option>
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

                <fieldset>
                    <h4 class="text-primary mb-3">Professional Details</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline me-5">
                                <input class="form-check-input profession_type" type="radio" name="profession_type"
                                    id="salariedTab" value="salaried" checked
                                    {{ old('profession_type', $professional->profession_type ?? '') == 'salaried' ? 'checked' : '' }}>
                                <label for="salariedTab">Salaried Employees</label>
                            </div>
                            <div class="form-check form-check-inline me-5">
                                <input class="form-check-input profession_type" type="radio" name="profession_type"
                                    id="selfTab" value="self"
                                    {{ old('profession_type', $professional->profession_type ?? '') == 'self' ? 'checked' : '' }}>
                                <label for="selfTab">Self Employed/ Business Professionals</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ old('company_name', $professional->company_name ?? '') }}"
                                    placeholder="Company Name" required>
                            </div>
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="industry" name="industry"
                                    value="{{ old('industry', $professional->industry ?? '') }}" placeholder="Industry"
                                    required>
                                <label for="industry">Nature of Business <span class="text-danger">*</span></label>
                            </div>
                            @error('industry')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="company_address" name="company_address"
                                value="{{ old('company_address', $professional->company_address ?? '') }}"
                                placeholder="Company Address" required>
                            <label for="company_address">Company Address <span class="text-danger">*</span></label>
                        </div>
                        @error('company_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="experience_year" name="experience_year"
                                    value="{{ old('experience_year', $professional->experience_year ?? '') }}"
                                    placeholder="Experience Year" required>
                                <label for="experience_year">Experience Year <span class="text-danger">*</span></label>
                            </div>
                            @error('experience_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="designation" name="designation"
                                    value="{{ old('designation', $professional->designation ?? '') }}"
                                    placeholder="Designation" required>
                                <label for="designation">Designation <span class="text-danger">*</span></label>
                            </div>
                            @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="netsalary">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="netsalary" name="netsalary"
                                    value="{{ old('netsalary', $professional->netsalary ?? '') }}"
                                    placeholder="Net Salary" required>
                                <label for="netsalary">Net Salary <span class="text-danger">*</span></label>
                            </div>
                            @error('netsalary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6" id="gross_salary">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="gross_salary" name="gross_salary"
                                    value="{{ old('gross_salary', $professional->gross_salary ?? '') }}"
                                    placeholder="Gross Salary" required>
                                <label for="gross_salary">Gross Salary <span class="text-danger">*</span></label>
                            </div>
                            @error('gross_salary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating" id="selfincome">
                                <input type="number" class="form-control" id="selfincome" name="selfincome"
                                    value="{{ old('selfincome', $professional->selfincome ?? '') }}"
                                    placeholder="Total Income">
                                <label for="selfincome">Total Income <span class="text-danger">*</span></label>
                            </div>
                            @error('selfincome')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating" id="business_establish_date">
                                <input type="date" class="form-control" id="business_establish_date"
                                    name="business_establish_date"
                                    value="{{ old('business_establish_date', isset($professional->business_establish_date) ? \Carbon\Carbon::parse($professional->business_establish_date)->format('Y-m-d') : '') }}"
                                    placeholder="Business Establish Date">
                                <label for="business_establish_date">Business Establish Date <span
                                        class="text-danger">*</span></label>
                            </div>
                            @error('business_establish_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <h4 class="text-primary mb-3">Qualification Details</h4>
                    <div class="row g-3">

                        <!-- Degree Dropdown (Qualification) -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="qualification" name="qualification" required>
                                    <option value="">Select Degree</option>
                                    <option value="Bachelors"
                                        {{ old('qualification', $education->qualification ?? '') == 'Bachelors' ? 'selected' : '' }}>
                                        Bachelors</option>
                                    <option value="Masters"
                                        {{ old('qualification', $education->qualification ?? '') == 'Masters' ? 'selected' : '' }}>
                                        Masters</option>
                                    <option value="PhD"
                                        {{ old('qualification', $education->qualification ?? '') == 'PhD' ? 'selected' : '' }}>
                                        PhD</option>
                                    <option value="Other"
                                        {{ old('qualification', $education->qualification ?? '') == 'Other' ? 'selected' : '' }}>
                                        Other</option>
                                </select>
                                <label for="qualification">Highest Degree</label>
                            </div>
                        </div>

                        <!-- If "Other" is selected, show a text input to specify the qualification -->
                        <div class="col-md-6" id="otherQualificationInput" style="display: none;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="other_qualification"
                                    name="other_qualification"
                                    value="{{ old('other_qualification', $education->other_qualification ?? '') }}"
                                    placeholder="Other Qualification">
                            </div>
                            <label for="other_qualification">Specify Other Degree</label>
                        </div>

                        <!-- Pass Year Dropdown -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="pass_year" name="pass_year" required>
                                    <option value="">Select Year</option>
                                    @for ($year = date('Y'); $year >= 1980; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('pass_year', $education->pass_year ?? '') == $year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                <label for="pass_year">Pass Year</label>
                            </div>
                        </div>

                        <!-- College Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="college_name" name="college_name"
                                    value="{{ old('college_name', $education->college_name ?? '') }}"
                                    placeholder="College Name" required>
                                <label for="college_name">College Name</label>
                            </div>
                        </div>

                        <!-- College Address -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="college_address" name="college_address"
                                    value="{{ old('college_address', $education->college_address ?? '') }}"
                                    placeholder="College Address" required>
                                <label for="college_address">College Address</label>
                            </div>
                        </div>

                    </div>
                </fieldset>

                <fieldset>
                    <h4 class="text-primary">Upload Documents</h4>
                    <div class="row g-3">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button border-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ID Proof
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show active"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded">
                                        <div class="row g-3">
                                            @foreach (['aadhar_card', 'pancard', 'passport', 'driving_license'] as $docType)
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="file" id="{{ $docType }}"
                                                            name="{{ $docType }}" class="form-control"
                                                            placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                        <label
                                                            for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>


                                                        <a href="" target="_blank">View Uploaded
                                                            {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    @if ($professional->profession_type == 'salaried')
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Residence Proof
                                        </button>
                                    @else
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Business Proof
                                        </button>
                                    @endif
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded">
                                        <div class="row g-3">
                                            @if ($professional->profession_type == 'salaried')

                                                @foreach (['light_bill', 'dl', 'rent_agree'] as $docType)
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="file" id="{{ $docType }}"
                                                                name="{{ $docType }}" class="form-control"
                                                                placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                            <label
                                                                for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>
                                                            @php
                                                                $existingDoc = $documents->firstWhere(
                                                                    'document_name',
                                                                    $docType,
                                                                );
                                                            @endphp
                                                            @if ($existingDoc)
                                                                <a href="{{ Storage::url($existingDoc->file_path) }}"
                                                                    target="_blank">View Uploaded
                                                                    {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach (['rent_agreement', 'light_bill', 'business_license'] as $docType)
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="file" id="{{ $docType }}"
                                                                name="{{ $docType }}" class="form-control"
                                                                placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                            <label
                                                                for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>

                                                            <a href="" target="_blank">View Uploaded
                                                                {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Income Proof
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">


                                            @foreach (['salary_slip', 'form_16'] as $docType)
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="file" id="{{ $docType }}"
                                                            name="{{ $docType }}" class="form-control"
                                                            placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                        <label
                                                            for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>

                                                        <a href="" target="_blank">View Uploaded
                                                            {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

                                                    </div>
                                                </div>
                                            @endforeach


                                            @foreach (['itr_with_tax_paid_challan', 'balance_sheet', 'bank_statement', 'bank_acount_statments'] as $docType)
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="file" id="{{ $docType }}"
                                                            name="{{ $docType }}" class="form-control"
                                                            placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                        <label
                                                            for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>

                                                        <a href="" target="_blank">View Uploaded
                                                            {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Employment Proof
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            @foreach (['offer_letter', 'hr_verification_letter'] as $docType)
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="file" id="{{ $docType }}"
                                                            name="{{ $docType }}" class="form-control"
                                                            placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                        <label
                                                            for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>


                                                        <a href="" target="_blank">View Uploaded
                                                            {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Other Documents
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">

                                            @foreach (['closure_letter', 'degree_certificate', 'propert_document', 'existing_loan_statment', 'saction_letter'] as $docType)
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="file" id="{{ $docType }}"
                                                            name="{{ $docType }}" class="form-control"
                                                            placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
                                                        <label
                                                            for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>

                                                        <a href="" target="_blank">View Uploaded
                                                            {{ ucfirst(str_replace('_', ' ', $docType)) }}</a>

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
                <fieldset>
                    <h4 class="text-primary mb-3">Loan Details</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" name="amount"
                                    value="{{ old('amount', $loan->amount ?? '') }}" class="form-control"
                                    id="amount" placeholder="Amount" required>
                                <label for="amount">Loan Amount</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="tenure" id="tenure" class="form-control" required>
                                    <option value="">Select Tenure</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('tenure', $loan->tenure ?? '') == $i ? 'selected' : '' }}>
                                            {{ $i }} year{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                                <label for="tenure">Tenure (in years)</label>
                            </div>
                        </div>

                        <!-- Referral Code Input -->

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="referral_code" value="{{ old('referral_code') }}"
                                    class="form-control" id="referral_code" placeholder="Referral Code">
                                <label for="referral_code">Referral Code (Optional)</label>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="pan_number"
                                    value="{{ old('pan_number', $loan->pan_number ?? '') }}" class="form-control"
                                    id="pan_number" placeholder="PAN Number">
                                <label for="pan_number">PAN Number</label>
                            </div>
                        </div>


                    </div>
                </fieldset>


                <div class="col-md-12">
                    <button name="next" class="btn btn-primary w-100 py-3" value="next" type="submit"
                        id="submit-btn">
                        Submit <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>



            <div class="card-body">
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>







@endsection

@section('script')
    @parent

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>




    <!--export button -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script> -->


    <script>
        document.getElementById('state').addEventListener('change', function() {

            const stateId = this.value;
            const citySelect = document.getElementById('city');
            citySelect.innerHTML = '<option value="">Select City</option>'; // Reset options

            if (stateId) {
                fetch(`http://localhost/jfinserv/cities/${stateId}`)
                    .then(response => response.json())
                    .then(cities => {
                        if (cities.length > 0) {
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id; // ID of city
                                option.textContent = city.city; // Name of city
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









    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const qualificationSelect = document.getElementById('qualification');
            const otherQualificationInput = document.getElementById('otherQualificationInput');

            // Show or hide the "Other" input based on selection
            qualificationSelect.addEventListener('change', function() {
                if (qualificationSelect.value === 'Other') {
                    otherQualificationInput.style.display = 'block';
                } else {
                    otherQualificationInput.style.display = 'none';
                }
            });

            // Initial check for "Other" already selected (if coming from saved data)
            if (qualificationSelect.value === 'Other') {
                otherQualificationInput.style.display = 'block';
            }
        });
    </script>




@endsection
