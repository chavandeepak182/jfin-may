@extends('layouts.header')

@section('title')
    @parent
    JFS | Loan Details
@endsection

@section('content')
@parent
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-left: 20px;">
        <li class="breadcrumb-item"><a href="{{ route('loans.index') }}">Loans List</a></li>
        <li class="breadcrumb-item"><a href="{{ route('loans.index') }}">All Loans</a></li>
        <li class="breadcrumb-item active" aria-current="page">Loan Details</li>
    </ol>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
    @if ($loan)
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
            <h2 class="h5 mb-3 mb-lg-0"><a href="{{ route('loans.index') }}" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a> Loan Details</h2>
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left-square me-2"></i> Back</a>
        </div>

        <!-- Main content -->
        <div class="row">
            <!-- Left side -->
            <div class="col-lg-8">
                <!-- Basic information -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Basic Information</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Loan Category</label>
                                    <input type="text" class="form-control" value="{{ $loan->loan_category_name ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Loan Amount</label>
                                    <input type="text" class="form-control" value="{{ $loan->amount ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>

                        <!-- More fields -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Loan Tenure</label>
                                    <input type="text" class="form-control" value="{{ $loan->tenure ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Applied By</label>
                                    <input type="text" class="form-control" value="{{ $loan->user_name ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                @if ($profile)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Profile Information</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" value="{{ $profile->mobile_no ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" class="form-control" value="{{ $profile->dob ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Marital Status</label>
                                    <input type="text" class="form-control" value="{{ $profile->marital_status ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Residence Address</label>
                                    <input type="text" class="form-control" value="{{ $profile->residence_address ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" value="{{ $profile->city ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" value="{{ $profile->state ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" class="form-control" value="{{ $profile->pincode ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Professional Information -->
                @if ($professional)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Professional Information</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" value="{{ $professional->company_name ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" class="form-control" value="{{ $professional->designation ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Industry</label>
                                    <input type="text" class="form-control" value="{{ $professional->industry ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Experience (Years)</label>
                                    <input type="text" class="form-control" value="{{ $professional->experience_year ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Net Salary</label>
                                    <input type="text" class="form-control" value="{{ $professional->netsalary ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Gross Salary</label>
                                    <input type="text" class="form-control" value="{{ $professional->gross_salary ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- Right side (if needed) -->
            <div class="col-lg-4">
                <!-- Educational Information -->
                @if ($education)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Educational Information</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Qualification</label>
                                    <input type="text" class="form-control" value="{{ $education->qualification ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">College Name</label>
                                    <input type="text" class="form-control" value="{{ $education->college_name ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pass Year</label>
                                    <input type="text" class="form-control" value="{{ $education->pass_year ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">College Address</label>
                                    <input type="text" class="form-control" value="{{ $education->college_address ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Documents -->
                @if ($documents)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Documents</h3>
                        <div class="row">
                            @foreach($documents as $document)
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">{{ ucfirst($document->document_name) }}</label>
                                    <input type="text" class="form-control" value="{{ $document->file_path }}" readonly />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                    <p>No documents found.</p>
                @endif
            </div>
        </div>
    @else
        <p>No loan details found.</p>
    @endif
</div>
@endsection
