@extends('frontend.layouts.customer-dash')
@section('title', 'All Personal Details')

@section('content')

<div class="container-fluid p-0">
    <div class="row g-4">

        {{-- ================= PERSONAL DETAILS ================= --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Personal Details</h5>
                    @if($profile)
                        <button class="btn btn-sm btn-primary rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                            <i class="far fa-edit me-1"></i> Edit
                        </button>
                    @endif
                </div>

                <div class="card-body">
                    @if($profile)
                        <h4 class="text-primary fw-bold mb-1">{{ $user->name ?? '—' }}</h4>
                        <p class="text-muted mb-3">{{ $user->email_id ?? '—' }}</p>

                        <p><strong>Mobile:</strong> {{ $profile->mobile_no ?? '—' }}</p>
                        <p>
                            <strong>Gender:</strong> {{ $profile->gender ?? '—' }}
                            <span class="mx-2">|</span>
                            <strong>DOB:</strong> {{ $profile->dob ?? '—' }}
                            <span class="mx-2">|</span>
                            <strong>Marital:</strong> {{ $profile->marital_status ?? '—' }}
                        </p>

                        <p><strong>Address:</strong> {{ $profile->residence_address ?? '—' }}</p>
                        <p>
                            <strong>City:</strong> {{ $profile->city ?? '—' }}
                            <span class="mx-2">|</span>
                            <strong>State:</strong> {{ $profile->state ?? '—' }}
                            <span class="mx-2">|</span>
                            <strong>Pincode:</strong> {{ $profile->pincode ?? '—' }}
                        </p>
                    @else
                        <div class="alert alert-info mb-0">
                            No personal information available.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= PROFESSIONAL DETAILS ================= --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Professional Details</h5>
                    <button class="btn btn-sm btn-primary rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#editProfessionalModal">
                        <i class="far fa-edit me-1"></i> Edit
                    </button>
                </div>

                <div class="card-body">
                    @if($professionalDetails)
                        <p><strong>Designation:</strong> {{ $professionalDetails->designation ?? '—' }}</p>
                        <p><strong>Company:</strong> {{ $professionalDetails->company_name ?? '—' }}</p>
                        <p><strong>Experience:</strong>
                            {{ $professionalDetails->experience_year ? $professionalDetails->experience_year.' yrs' : '—' }}
                        </p>
                        <p><strong>Industry:</strong> {{ $professionalDetails->industry ?? '—' }}</p>
                        <p><strong>Company Address:</strong> {{ $professionalDetails->company_address ?? '—' }}</p>
                    @else
                        <div class="alert alert-info mb-0">
                            No professional details added yet.
                        </div>
                    @endif
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



        {{-- ================= DOCUMENTS ================= --}}
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Documents</h5>
                </div>

                <div class="card-body">

                    {{-- Uploaded Documents --}}
                    @if($documents && count($documents))
                        <div class="list-group mb-4">
                            @foreach($documents as $document)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 text-capitalize text-dark">
                                            {{ $document->document_name ?? 'Document' }}
                                        </h6>
                                        <!-- <small class="text-muted">
                                            Uploaded: {{ optional($document->created_at)->format('d M Y') ?? '—' }}
                                        </small> -->
                                    </div>

                                    <a href="{{ Storage::url($document->file_path) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            No documents uploaded yet.
                        </div>
                    @endif

                    {{-- Upload Documents --}}
                    <form action="{{ route('loan.update_documents') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="documents-form">
                        @csrf
						<input type="hidden" name="user_id" value="{{ session('user_id') }}">
                        <div id="document-fields" class="mb-4"></div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" id="add-document" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Add Document
                            </button>
                            <button type="submit" id="submit-documents" class="btn btn-success" disabled>
                                <i class="fas fa-save me-2"></i> Save Documents
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('custom-script')
<script>
document.getElementById('add-document').addEventListener('click', function () {
    const index = document.querySelectorAll('.document-field').length;
    document.getElementById('document-fields').insertAdjacentHTML('beforeend', `
        <div class="document-field mb-3">
            <input type="text" name="documents[${index}][document_name]" class="form-control mb-2" placeholder="Document Name" required>
            <input type="file" name="documents[${index}][file]" class="form-control mb-2" required>
            <button type="button" class="btn btn-danger remove-document">Remove</button>
        </div>
    `);
    document.getElementById('submit-documents').disabled = false;
});

document.getElementById('document-fields').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-document')) {
        e.target.closest('.document-field').remove();
    }
});
</script>
@endsection