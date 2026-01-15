@extends('frontend.layouts.customer-dash')
@section('title', 'All Personal Details')

@section('content')

<style>
.profile-card {
    transition: all 0.25s ease;
    border-radius: 14px;
}

.profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.08);
}

.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.section-value {
    font-weight: 600;
    color: #1e293b;
}
</style>

<div class="container-fluid p-0">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1 text-dark">Profile & Settings</h3>
        <p class="text-muted mb-0">
            View and manage your personal and professional information
        </p>
    </div>

    <div class="row g-4">

        {{-- ================= PERSONAL DETAILS ================= --}}
        <div class="col-xl-6">
            <div class="card shadow-sm border-0 h-100 profile-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-primary bg-opacity-10">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Personal Details</h5>
                            <small class="text-muted">Basic personal information</small>
                        </div>
                    </div>

                    @if($profile)
                        <button class="btn btn-sm btn-outline-primary rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                            <i class="far fa-edit me-1"></i> Edit
                        </button>
                    @endif
                </div>

                <div class="card-body">
                    @if($profile)

                        <h4 class="fw-bold mb-1">{{ $user->name ?? '—' }}</h4>
                        <p class="text-muted mb-4">{{ $user->email_id ?? '—' }}</p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <small class="text-muted">Mobile</small>
                                <div class="section-value">{{ $profile->mobile_no ?? '—' }}</div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Gender</small>
                                <div class="section-value">{{ $profile->gender ?? '—' }}</div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Date of Birth</small>
                                <div class="section-value">{{ $profile->dob ?? '—' }}</div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Marital Status</small>
                                <div class="section-value">{{ $profile->marital_status ?? '—' }}</div>
                            </div>

                            <div class="col-12 mt-2">
                                <small class="text-muted">Residential Address</small>
                                <div class="section-value">
                                    {{ $profile->residence_address ?? '—' }},
                                    {{ $profile->city ?? '—' }},
                                    {{ $profile->state ?? '—' }} - {{ $profile->pincode ?? '—' }}
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="alert alert-info mb-0">
                            No personal information available.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= PROFESSIONAL DETAILS ================= --}}
        <div class="col-xl-6">
            <div class="card shadow-sm border-0 h-100 profile-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-primary bg-opacity-10">
							<i class="fas fa-briefcase text-primary"></i>
						</div>
                        <div>
                            <h5 class="mb-0 fw-bold">Professional Details</h5>
                            <small class="text-muted">Employment & work information</small>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-outline-primary rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#editProfessionalModal">
                        <i class="far fa-edit me-1"></i> Edit
                    </button>
                </div>

                <div class="card-body">
                    @if($professionalDetails)

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <small class="text-muted">Designation</small>
                                <div class="section-value">{{ $professionalDetails->designation ?? '—' }}</div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Company</small>
                                <div class="section-value">{{ $professionalDetails->company_name ?? '—' }}</div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Experience</small>
                                <div class="section-value">
                                    {{ $professionalDetails->experience_year ? $professionalDetails->experience_year.' yrs' : '—' }}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <small class="text-muted">Industry</small>
                                <div class="section-value">{{ $professionalDetails->industry ?? '—' }}</div>
                            </div>

                            <div class="col-12">
                                <small class="text-muted">Company Address</small>
                                <div class="section-value">{{ $professionalDetails->company_address ?? '—' }}</div>
                            </div>
                        </div>

                    @else
                        <div class="alert alert-info mb-0">
                            No professional details added yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- ================= EDIT PERSONAL DETAILS MODAL ================= -->
		<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Personal Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<form action="{{ route('user.profile.update') }}" method="POST">
						@csrf
						<input type="hidden" name="user_id" value="{{ $user->id }}">

						<div class="modal-body row g-3">

							<div class="col-md-6">
								<label class="form-label">Name</label>
								<input type="text" name="name"
									class="form-control"
									value="{{ old('name', $user->name ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Email</label>
								<input type="email" name="email_id"
									class="form-control"
									value="{{ old('email_id', $user->email_id ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Mobile No</label>
								<input type="text" name="mobile_no"
									class="form-control"
									value="{{ old('mobile_no', $profile->mobile_no ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Date of Birth</label>
								<input type="date" name="dob"
									class="form-control"
									value="{{ old('dob', $profile->dob ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Gender</label>
								<input type="text" name="gender"
									class="form-control"
									value="{{ old('gender', $profile->gender ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Marital Status</label>
								<input type="text" name="marital_status"
									class="form-control"
									value="{{ old('marital_status', $profile->marital_status ?? '') }}">
							</div>

							<div class="col-12">
								<label class="form-label">Residence Address</label>
								<input type="text" name="residence_address"
									class="form-control"
									value="{{ old('residence_address', $profile->residence_address ?? '') }}">
							</div>

							<div class="col-md-4">
								<label class="form-label">City</label>
								<input type="text" name="city"
									class="form-control"
									value="{{ old('city', $profile->city ?? '') }}">
							</div>

							<div class="col-md-4">
								<label class="form-label">State</label>
								<input type="text" name="state"
									class="form-control"
									value="{{ old('state', $profile->state ?? '') }}">
							</div>

							<div class="col-md-4">
								<label class="form-label">Pincode</label>
								<input type="text" name="pincode"
									class="form-control"
									value="{{ old('pincode', $profile->pincode ?? '') }}">
							</div>

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- ================= EDIT PROFESSIONAL DETAILS MODAL ================= -->
		<div class="modal fade" id="editProfessionalModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Professional Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<form action="{{ route('user.professional.update') }}" method="POST">
						@csrf
						<input type="hidden" name="professional_id"
							value="{{ $professionalDetails->professional_id ?? '' }}">

						<div class="modal-body row g-3">

							<div class="col-md-6">
								<label class="form-label">Profession Type</label>
								<input type="text" name="profession_type"
									class="form-control"
									value="{{ old('profession_type', $professionalDetails->profession_type ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Designation</label>
								<input type="text" name="designation"
									class="form-control"
									value="{{ old('designation', $professionalDetails->designation ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Company Name</label>
								<input type="text" name="company_name"
									class="form-control"
									value="{{ old('company_name', $professionalDetails->company_name ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Industry</label>
								<input type="text" name="industry"
									class="form-control"
									value="{{ old('industry', $professionalDetails->industry ?? '') }}">
							</div>

							<div class="col-md-6">
								<label class="form-label">Experience (Years)</label>
								<input type="number" name="experience_year"
									class="form-control"
									value="{{ old('experience_year', $professionalDetails->experience_year ?? '') }}">
							</div>

							<div class="col-12">
								<label class="form-label">Company Address</label>
								<input type="text" name="company_address"
									class="form-control"
									value="{{ old('company_address', $professionalDetails->company_address ?? '') }}">
							</div>

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>

{{-- ================= BANK DETAILS ================= --}}
<div class="col-xl-6">
    <div class="card shadow-sm border-0 h-100 profile-card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-circle bg-primary bg-opacity-10">
                    <i class="fas fa-university text-primary"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">Bank Details</h5>
                    <small class="text-muted">Withdrawal account information</small>
                </div>
            </div>

            <button class="btn btn-sm btn-outline-primary rounded-pill"
                    data-bs-toggle="modal"
                    data-bs-target="#bankDetailsModal">
                <i class="far fa-edit me-1"></i>
                {{ $bankDetails ? 'Edit' : 'Add' }}
            </button>
        </div>

        <div class="card-body">
            @if($bankDetails)
                <div class="row g-3">

                    <div class="col-sm-6">
                        <small class="text-muted">Bank Name</small>
                        <div class="section-value">{{ $bankDetails->bank_name }}</div>
                    </div>

                    <div class="col-sm-6">
                        <small class="text-muted">Account Number</small>
                        <div class="section-value">
                            ****{{ substr($bankDetails->account_no, -4) }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <small class="text-muted">IFSC Code</small>
                        <div class="section-value">{{ $bankDetails->ifsc_code }}</div>
                    </div>

                    <div class="col-sm-6">
                        <small class="text-muted">Branch Name</small>
                        <div class="section-value">{{ $bankDetails->branch_name }}</div>
                    </div>

                    <div class="col-sm-6">
                        <small class="text-muted">UPI ID</small>
                        <div class="section-value">{{ $bankDetails->upi_id ?? '—' }}</div>
                    </div>

                </div>
            @else
                <div class="alert alert-warning mb-0">
                    Bank details not added yet.
                </div>
            @endif
        </div>
    </div>
</div>


<!-- ================= BANK DETAILS MODAL ================= -->
<div class="modal fade" id="bankDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $bankDetails ? 'Edit Bank Details' : 'Add Bank Details' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('user.bank.save') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="modal-body row g-3">

                    <!-- Bank Name -->
                    <div class="col-md-6">
                        <label class="form-label">Bank Name</label>
                        <input type="text"
                               name="bank_name"
                               class="form-control @error('bank_name') is-invalid @enderror"
                               value="{{ old('bank_name', $bankDetails->bank_name ?? '') }}"
                               required
                               pattern="[A-Za-z ]+"
                               oninput="this.value=this.value.replace(/[^A-Za-z ]/g,'')">
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="col-md-6">
                        <label class="form-label">Account Number</label>
                        <input type="text"
                               name="account_no"
                               class="form-control @error('account_no') is-invalid @enderror"
                               value="{{ old('account_no', $bankDetails->account_no ?? '') }}"
                               required
                               pattern="[0-9]+"
                               maxlength="18"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        @error('account_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- IFSC Code -->
                    <div class="col-md-6">
                        <label class="form-label">IFSC Code</label>
                        <input type="text"
                               name="ifsc_code"
                               class="form-control text-uppercase @error('ifsc_code') is-invalid @enderror"
                               value="{{ old('ifsc_code', $bankDetails->ifsc_code ?? '') }}"
                               placeholder="SBIN0001234"
                               required>
                        @error('ifsc_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Branch Name -->
                    <div class="col-md-6">
                        <label class="form-label">Branch Name</label>
                        <input type="text"
                               name="branch_name"
                               class="form-control @error('branch_name') is-invalid @enderror"
                               value="{{ old('branch_name', $bankDetails->branch_name ?? '') }}"
                               required
                               pattern="[A-Za-z ]+"
                               oninput="this.value=this.value.replace(/[^A-Za-z ]/g,'')">
                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- UPI ID -->
                     <div class="col-md-6">
                        <label class="form-label">Branch Name</label>
                        <input type="text"
                            name="upi_id"
                            class="form-control @error('upi_id') is-invalid @enderror"
                            value="{{ old('upi_id', $bankDetails->upi_id ?? '') }}"
                            placeholder="example@upi"
                            pattern="[a-zA-Z0-9._-]+@[a-zA-Z]{2,}"
                            title="Enter a valid UPI ID (example@bank)"
                          oninput="this.value=this.value.replace(/[^a-zA-Z0-9._@-]/g,'')">
                      </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Bank Details
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



</div>
@endsection
