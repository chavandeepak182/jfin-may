@extends($layout)

@section('title', 'Apply for a Loan | Jfinserv')

@section('content')

<!-- Professional Details -->
<div class="container-fluid contact bg-light py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center">
                    <div class="contact-img-inner text-center">
                        <img src="{{ asset('theme') }}/frontend/img/docs.png" class="img-fluid w-75" alt="Image">
                    </div>
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

            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                <form action="{{ route('loan.handle_step') }}" method="POST" enctype="multipart/form-data" role="form" autocomplete="off" class="form">
                    @csrf
                    <input type="hidden" name="current_step" value="{{ $currentStep }}">
                    <input type="hidden" name="is_loan" value="{{ $is_loan }}">


                            <!-- Personal Details -->
                            @if ($currentStep == 1)
                                <fieldset>
                                    <h4 class="text-primary mb-3">Personal Details</h4>
                                    @if (session('role_id') == 4)
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select name="user_id" id="user_id" class="form-control" required>
                                                        <option value="">Select User</option>
                                                        @foreach ($loanUsers as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ old('user_id', $loan->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }} ({{ $user->email_id }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="user_id">User <span class="text-danger">*</span></label>
                                                    @error('user_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select name="loan_category_id" id="loan_category" class="form-control"
                                                    required>
                                                    <option value="">Select Loan Category</option>
                                                    @foreach ($loanCategories as $category)
                                                        <option value="{{ $category->loan_category_id }}"
                                                            {{ old('loan_category_id', $loan->loan_category_id ?? '') == $category->loan_category_id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="loan_category">Loan  <span
                                                        class="text-danger">*</span></label>
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

                            <div class="col-md-12">
                                <h4 class="text-primary">Personal Details</h4>
                            </div>


                                      <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="text" name="pan_number"
                                                            value="{{ old('pan_number', $profile->pan_number ?? '') }}"
                                                            class="form-control"
                                                            id="pan_number"
                                                            placeholder="PAN Number"
                                                            pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}"
                                                            maxlength="10"
                                                            title="Enter valid 10-character PAN (e.g., ABCDE1234F)"
                                                            oninput="this.value = this.value.toUpperCase()">
                                                        <label for="pan_number">PAN Number</label>

                                                        @error('pan_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                           <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control"
                                                        id="phone"
                                                        name="mobile_no"
                                                        value="{{ old('mobile_no', $profile->mobile_no ?? $user->mobile_no) }}"
                                                        placeholder="Phone"
                                                        maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                                        required>
                                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                                    <span id="phone-error" class="text-danger" style="font-size: 13px;"></span>
                                                    @error('mobile_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="date" class="form-control border-0" id="dob" name="dob" 
				                        value="{{ old('dob', $profile->dob ?? '') }}" placeholder="DOB" required>
				                    <label for="dob">Date of Birth</label>
				                    @error('dob')
				                        <span class="text-danger">{{ $message }}</span>
				                    @enderror
				                </div>
				            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <select class="form-control border-0" id="marital_status" name="marital_status" required>
				                        <option value="" selected disabled hidden>Select Marital Status</option>
				                        <option value="Single" {{ old('marital_status', $profile->marital_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
				                        <option value="Married" {{ old('marital_status', $profile->marital_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
				                    </select>
				                    <label for="marital_status">Marital Status</label>
				                    @error('marital_status')
				                        <span class="text-danger">{{ $message }}</span>
				                    @enderror
				                </div>
				            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="text" class="form-control border-0" id="residence_address" name="residence_address" 
				                        value="{{ old('residence_address', $profile->residence_address ?? '') }}" placeholder="Address" required>
				                    <label for="residence_address">Address</label>
				                    @error('residence_address')
				                        <span class="text-danger">{{ $message }}</span>
				                    @enderror
				                </div>
				            </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-control" id="state" name="state" required>
                                                    <option value="">Select State <span class="text-danger">*</span>
                                                    </option>
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
                                                <input type="text" 
                                                    class="form-control" 
                                                    id="pincode" 
                                                    name="pincode"
                                                    value="{{ old('pincode', $profile->pincode ?? '') }}"
                                                    placeholder="Pincode"
                                                    maxlength="6"
                                                    required
                                                    inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6)">
                                                <label for="pincode">Pincode <span class="text-danger">*</span></label>

                                                <span id="pincode-error" class="text-danger" style="font-size: 13px;"></span>

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
				        <div class="row g-3">
				            <h4 class="text-primary">Professional Details</h4>
				            <div class="col-md-12">
				                <div class="form-check form-check-inline me-5">
				                    <input class="form-check-input profession_type" type="radio" name="profession_type" id="salariedTab" value="salaried" 
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
                                                <input type="text" class="form-control" id="company_name"
                                                    name="company_name"
                                                    value="{{ old('company_name', $professional->company_name ?? '') }}"
                                                    placeholder="Company Name" required>
                                                <label for="company_name">Company Name <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('company_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="industry"
                                                    name="industry"
                                                    value="{{ old('industry', $professional->industry ?? '') }}"
                                                    placeholder="Industry" required>
                                                <label for="industry">Nature of Business <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('industry')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="company_address"
                                                    name="company_address"
                                                    value="{{ old('company_address', $professional->company_address ?? '') }}"
                                                    placeholder="Company Address" required>
                                                <label for="company_address">Company Address <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('company_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="number" class="form-control border-0" id="experience_year" name="experience_year" value="{{ old('experience_year', $professional->experience_year ?? '') }}" placeholder="Experience Year" required>
				                    <label for="experience_year">Experience Year</label>
				                </div>
				                @error('experience_year')
				                    <span class="text-danger">{{ $message }}</span>
				                @enderror
				            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="text" class="form-control border-0" id="designation" name="designation" value="{{ old('designation', $professional->designation ?? '') }}" placeholder="Designation" required>
				                    <label for="designation">Designation</label>
				                </div>
				                @error('designation')
				                    <span class="text-danger">{{ $message }}</span>
				                @enderror
				            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="number" class="form-control border-0" id="netsalary" name="netsalary" value="{{ old('netsalary', $professional->netsalary ?? '') }}" placeholder="Net Salary" required>
				                    <label for="netsalary">Net Salary</label>
				                </div>
				                @error('netsalary')
				                    <span class="text-danger">{{ $message }}</span>
				                @enderror
				            </div>

				            <div class="col-md-6">
				                <div class="form-floating">
				                    <input type="number" class="form-control border-0" id="gross_salary" name="gross_salary" value="{{ old('gross_salary', $professional->gross_salary ?? '') }}" placeholder="Gross Salary" required>
				                    <label for="gross_salary">Gross Salary</label>
				                </div>
				                @error('gross_salary')
				                    <span class="text-danger">{{ $message }}</span>
				                @enderror
				            </div>

                                        @if ($professional && $professional->profession_type != 'salaried')
                                            <div class="col-md-6">
                                                <div class="form-floating" id="selfincome">
                                                    <input type="number" class="form-control" id="selfincome"
                                                        name="selfincome"
                                                        value="{{ old('selfincome', $professional->selfincome ?? '') }}"
                                                        placeholder="Total Income">
                                                    <label for="selfincome">Total Income <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                @error('selfincome')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

				        </div>
				    </fieldset>

                    <!-- Qualification Details -->
                    @elseif ($currentStep == 3)
                        <fieldset>
                            <div class="row g-3">
                                <h4 class="text-primary">Qualification Details</h4>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="qualification" name="qualification" value="{{ old('qualification', $education->qualification ?? '') }}" placeholder="Qualification" required>
                                        <label for="qualification">Highest Degree</label>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control border-0" id="pass_year" name="pass_year" value="{{ old('pass_year', $education->pass_year ?? '') }}" placeholder="pass_year" required>
                                        <label for="pass_year">Pass Year</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="college_name" name="college_name" value="{{ old('college_name', $education->college_name ?? '') }}" placeholder="College Name" required>
                                        <label for="college_name">College Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="college_address" name="college_address" value="{{ old('college_address', $education->college_address ?? '') }}" placeholder="College Address" required>
                                        <label for="college_address">College Address</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

						<!-- Existing Loan Details -->
@elseif ($currentStep == 4)
<fieldset>
    <h4 class="text-primary">Existing Loan Details (Optional)</h4>
    <div id="existing-loans-container">
        @if (!empty($existingLoans) && count($existingLoans) > 0)
            @foreach($existingLoans as $existingLoan)
                <div class="existing-loan-entry mb-3" id="existing-loan-{{ $loop->index }}">
                    <input type="hidden" name="existing_loan_id[]" value="{{ $existingLoan->existing_loan_id ?? '' }}">
                    <div class="row g-3">
                        <!-- Type of Loan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="type_loan[]" value="{{ old('type_loan.' . $loop->index, $existingLoan->type_loan ?? '') }}" class="form-control" placeholder="Type of Loan">
                                <label>Type of Loan</label>
                            </div>
                        </div>
                        
                        <!-- Loan Amount -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" name="loan_amount[]" value="{{ old('loan_amount.' . $loop->index, $existingLoan->loan_amount ?? '') }}" class="form-control" placeholder="Loan Amount">
                                <label>Loan Amount</label>
                            </div>
                        </div>

                        <!-- Tenure of Loan -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="tenure_loan[]" value="{{ old('tenure_loan.' . $loop->index, $existingLoan->tenure_loan ?? '') }}" class="form-control" placeholder="Tenure of Loan (in months)">
                                <label>Tenure of Loan (in months)</label>
                            </div>
                        </div>

                        <!-- EMI Amount -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" name="emi_amount[]" value="{{ old('emi_amount.' . $loop->index, $existingLoan->emi_amount ?? '') }}" class="form-control" placeholder="EMI Amount">
                                <label>EMI Amount</label>
                            </div>
                        </div>

                        <!-- Sanction Date -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="sanction_date[]" value="{{ old('sanction_date.' . $loop->index, $existingLoan->sanction_date ?? '') }}" class="form-control">
                                <label>Sanction Date</label>
                            </div>
                        </div>

                        <!-- EMI Bounce Count -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="emi_bounce_count[]" value="{{ old('emi_bounce_count.' . $loop->index, $existingLoan->emi_bounce_count ?? '') }}" class="form-control" placeholder="EMI Bounce Count">
                                <label>EMI Bounce Count</label>
                            </div>
                        </div>

                        <!-- Remove Button for each entry -->
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger" onclick="removeLoanEntry({{ $loop->index }})">Remove Loan</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No existing loans found.</p>
        @endif
    </div>

    <!-- Add Another Loan Button -->
    <div class="col-md-12 mt-3 d-flex justify-content-between">
        <button type="button" class="btn btn-primary" id="add-loan-button" onclick="addLoanEntry()">Add Another Loan</button>
    </div>
</fieldset>

                    <!-- Upload Documents -->
                    @elseif ($currentStep == 5)
					    <fieldset>
					        <div class="row g-3">
					            <h4 class="text-primary">Upload Documents</h4>
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
                                                                <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control border-0" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
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
                                                                <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control border-0" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
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
                                                                <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control border-0" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
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
                                                                <input type="file" id="{{ $docType }}" name="{{ $docType }}" class="form-control border-0" placeholder="{{ ucfirst(str_replace('_', ' ', $docType)) }}">
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
                    @elseif ($currentStep == 6)
					    <fieldset>
					        <div class="row g-3">
					            <h4 class="text-primary">Loan Details</h4>
					            
					        
					            <div class="col-md-6">
					                <div class="form-floating">
					                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $loan->amount ?? '') }}" class="form-control border-0" id="amount" placeholder="Amount" required>
					                    <label for="amount">Loan Amount</label>
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-floating">
					                    <select name="tenure" class="form-select border-0" id="tenure" required>
					                        <option value="">Select Tenure</option>
					                        @for ($i = 1; $i <= 10; $i++)
					                            <option value="{{ $i }}" {{ old('tenure', $loan->tenure ?? '') == $i ? 'selected' : '' }}>{{ $i }} year{{ $i > 1 ? 's' : '' }}</option>
					                        @endfor
					                    </select>
					                    <label for="tenure">Tenure (in years)</label>
					                </div>
					            </div>
					            <div class="row mt-2">
                                    <!-- Referral Code Input -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="referral_code" value="{{ old('referral_code') }}" class="form-control border-0" id="referral_code" placeholder="Referral Code">
                                            <label for="referral_code">Referral Code (Optional)</label>
                                        </div>
                                    </div>

                                    <!-- Promo Code Input -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="pan_number" value="{{ old('pan_number', $loan->pan_number ?? '') }}" class="form-control border-0" id="pan_number" placeholder="PAN Number">
                                            <label for="pan_number">PAN Number</label>
                                        </div>
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
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <input name="previous" class="btn btn-primary w-75 py-3" value="Previous" type="button" onclick="history.back();">
                        </div>
                        <div class="col-md-6">
                            <input name="recover-submit" class="btn btn-dark w-75 py-3" value="Next" type="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('add-loan-button').addEventListener('click', function() {
        const container = document.getElementById('existing-loans-container');
        const index = container.children.length;

        const newLoanHTML = `
            <div class="existing-loan-entry">
                <input type="hidden" name="existing_loan_id[]" value="">
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="type_loan[]" class="form-control" placeholder="Type of Loan">
                            <label>Type of Loan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" step="0.01" name="loan_amount[]" class="form-control" placeholder="Loan Amount">
                            <label>Loan Amount</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="tenure_loan[]" class="form-control" placeholder="Tenure of Loan (in months)">
                            <label>Tenure of Loan (in months)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" step="0.01" name="emi_amount[]" class="form-control" placeholder="EMI Amount">
                            <label>EMI Amount</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="sanction_date[]" class="form-control">
                            <label>Sanction Date</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="emi_bounce_count[]" class="form-control" placeholder="EMI Bounce Count">
                            <label>EMI Bounce Count</label>
                        </div>
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
        .step-icon {
    font-size: 1.3rem;      /* slightly bigger than text */
    color: #0d6efd;         /* bootstrap primary blue */
    vertical-align: middle; /* align with text */
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery included -->

    <script>
        $(document).ready(function() {
            $("#fetchReportBtn").click(function() {
                fetchCreditReport();
            });
        });

        function fetchCreditReport() {
            let requestData = {
                name: $("#full_name").val(),

                mobile: $("#phone").val(),
                pan: $("#pan_number").val()
            };

            $.ajax({
                url: "http://localhost/jfinserv/fetch-credit-report", // Laravel route for controller function
                type: "POST",
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(requestData),
                success: function(response) {
                    console.log("Report fetched successfully", response);
                    // Handle response (e.g., download file)
                },
                error: function(error) {
                    console.error("Error fetching report", error);
                }
            });
        }



        document.getElementById('state').addEventListener('change', function() {
            const stateId = this.value;
            const citySelect = document.getElementById('city');
            citySelect.innerHTML = '<option value="">Select City</option>'; // Reset options

            if (stateId) {
                fetch(`/cities/${stateId}`)
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
        document.getElementById('check-referral-code').addEventListener('click', function() {
            const referralCode = document.getElementById('referral_code').value;

            if (referralCode.trim() === '') {
                alert('Please enter a referral code.');
                return;
            }

            fetch('{{ route('check.referral_code') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        referral_code: referralCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const feedbackElement = document.getElementById('referral-feedback');
                    if (data.success) {
                        // Show success message along with the user's name
                        feedbackElement.innerHTML =
                            `<div class="alert alert-success">${data.message} Referred by: ${data.user_name}</div>`;
                    } else {
                        // Show error message
                        feedbackElement.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('referral-feedback').innerHTML =
                        '<div class="alert alert-danger">An error occurred while checking the referral code.</div>';
                });
        });
    </script> 

    <script>
        let referralCodeChecked = false; // Flag to track if referral code has been checked

        document.getElementById('check-referral-code').addEventListener('click', function() {
            const referralCode = document.getElementById('referral_code').value.trim();
            const feedbackElement = document.getElementById('referral-feedback');
            const submitButton = document.getElementById('submit-btn'); // Submit button

            // If referral code is empty, allow form submission without checking
            if (referralCode === '') {
                feedbackElement.innerHTML = ''; // Clear any feedback
                referralCodeChecked = true; // Mark as checked
                submitButton.disabled = false; // Enable submit button
                return; // Don't check the referral code, let the form submit
            }

            // Make an API call to validate the referral code if not empty
            fetch('{{ route('check.referral_code') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        referral_code: referralCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Referral code is valid
                        feedbackElement.innerHTML =
                            `<div class="alert alert-success">${data.message} Referred by: ${data.user_name}</div>`;
                        referralCodeChecked = true; // Mark as checked
                        submitButton.disabled = false; // Enable submit button
                    } else {
                        // Referral code is invalid
                        feedbackElement.innerHTML =
                            `<div class="alert alert-danger">Check your referral code</div>`;
                        referralCodeChecked = false; // Mark as not checked
                        submitButton.disabled = true; // Disable submit button if the referral code is invalid
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    feedbackElement.innerHTML =
                        '<div class="alert alert-danger">An error occurred while checking the referral code.</div>';
                    referralCodeChecked = false; // Mark as not checked
                    submitButton.disabled = true; // Disable submit button if there's an error
                });
        });

        // Prevent form submission if referral code is not checked or is invalid
        document.getElementById('submit-btn').addEventListener('click', function(event) {
            const referralCode = document.getElementById('referral_code').value.trim();

            // If referral code is filled and hasn't been checked or is invalid, prevent form submission
            if (referralCode !== '' && !referralCodeChecked) {
                event.preventDefault(); // Prevent form from being submitted
                alert('Please check your referral code before submitting.');
            }
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
    
<script>
document.getElementById('pincode').addEventListener('input', function() {
    const val = this.value;
    const errorSpan = document.getElementById('pincode-error');

    // Allow only digits
    this.value = val.replace(/[^0-9]/g, '');

    // Show inline error if not 6 digits yet
    if (val.length > 0 && val.length < 6) {
        errorSpan.textContent = 'Please enter a 6-digit pincode.';
    } else {
        errorSpan.textContent = '';
    }
});
</script>

@endsection
