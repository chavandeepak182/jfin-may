@extends('frontend.layouts.customer-dash')
@section('title', "All Personal Details")

@section('content')
<div class="container p-0">
	<div class="row g-4">
		<div class="col-md-6">
			<h3 class="mb-3">Personal Details</h3>
			<div class="w-100">
				@if ($profile)
					<div class="bg-white py-5 px-5 rounded">
						<h4 class="m-0 text-primary"><strong>{{ $user->name }}</strong></h4>
						<p>{{ $user->email_id }}</p>
						<p class="m-0">Mobile No.: <strong>{{ $profile->mobile_no }}</strong></p>
						<p>Gender: <strong>{{ $profile->gender }}</strong> <span class="px-2">|</span> DOB: <strong>{{ $profile->dob }}</strong> <span class="px-2">|</span> Marital Status: <strong>{{ $profile->marital_status }}</strong></p>
						<p class="m-0">Residence: <strong>{{ $profile->residence_address }}</strong></p>
						<p>City: <strong>{{ $profile->city }}</strong> <span class="px-2">|</span> State: <strong>{{ $profile->state }}</strong> <span class="px-2">|</span> Pincode: <strong>{{ $profile->pincode }}</strong></p>
						<p class="mt-5"><a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="far fa-edit me-2"></i> Update</a></p>
					</div>
				@else
					<p>No personal information available.</p>
				@endif
			</div>

			<!-- Edit Profile Modal -->
			<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editProfileModalLabel">Edit Personal Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('user.profile.update') }}" method="POST">
								@csrf
								<input type="hidden" name="user_id" value="{{ $user->id }}">

								<!-- Name -->
								<div class="mb-3">
									<label for="name" class="form-label">Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
									@error('name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Email ID -->
								<div class="mb-3">
									<label for="email_id" class="form-label">Email ID</label>
									<input type="email" class="form-control @error('email_id') is-invalid @enderror" id="email_id" name="email_id" value="{{ old('email_id', $user->email_id) }}">
									@error('email_id')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Mobile No -->
								<div class="mb-3">
									<label for="mobile_no" class="form-label">Mobile No</label>
									<input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $profile->mobile_no) }}">
									@error('mobile_no')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="dob" class="form-label">Date of Birth</label>
									<input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $profile->dob) }}">
									@error('dob')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="marital_status" class="form-label">Marital Status</label>
									<input type="text" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status" name="marital_status" value="{{ old('marital_status', $profile->marital_status) }}">
									@error('marital_status')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="residence_address" class="form-label">Residence Address</label>
									<input type="text" class="form-control @error('residence_address') is-invalid @enderror" id="residence_address" name="residence_address" value="{{ old('residence_address', $profile->residence_address) }}">
									@error('residence_address')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="city" class="form-label">City</label>
									<input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $profile->city) }}">
									@error('city')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="state" class="form-label">State</label>
									<input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $profile->state) }}">
									@error('state')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="pincode" class="form-label">Pincode</label>
									<input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ old('pincode', $profile->pincode) }}">
									@error('pincode')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<h3 class="mb-3">Professional Details</h3>
			<div class="w-100">
				@if ($professionalDetails)
					<div class="bg-white py-5 px-5 rounded">
						<p>Designation: <strong>{{ $professionalDetails->designation }}</strong></p>
						<p>Company Name: <strong>{{ $professionalDetails->company_name }}</strong></p>
						<p>Years of Experience: <strong>{{ $professionalDetails->experience_year }} yrs</strong></p>
						<p>Company Address: <strong>{{ $professionalDetails->company_address }}</strong></p>
						<p>Industry: <strong>{{ $professionalDetails->industry }}</strong></p>
						<p class="mt-5">
							<a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfessionalModal">
								<i class="far fa-edit me-2"></i> Update
							</a>
						</p>
					</div>
				@else
					<p>No professional information available. Please add your details.</p>
				@endif
			</div>

			<!-- Edit Professional Modal -->
			<div class="modal fade" id="editProfessionalModal" tabindex="-1" aria-labelledby="editProfessionalModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editProfessionalModalLabel">Edit Professional Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('user.professional.update') }}" method="POST">
								@csrf
								<input type="hidden" name="professional_id" value="{{ $professionalDetails->professional_id ?? '' }}">

								<!-- Profession Type -->
								<div class="mb-3">
									<label for="profession_type" class="form-label">Profession Type</label>
									<input type="text" class="form-control @error('profession_type') is-invalid @enderror" id="profession_type" name="profession_type" value="{{ old('profession_type', $professionalDetails->profession_type ?? '') }}">
									@error('profession_type')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Company Name -->
								<div class="mb-3">
									<label for="company_name" class="form-label">Company Name</label>
									<input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $professionalDetails->company_name ?? '') }}">
									@error('company_name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Years of Experience -->
								<div class="mb-3">
									<label for="experience_year" class="form-label">Years of Experience</label>
									<input type="number" class="form-control @error('experience_year') is-invalid @enderror" id="experience_year" name="experience_year" value="{{ old('experience_year', $professionalDetails->experience_year ?? '') }}">
									@error('experience_year')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Company Address -->
								<div class="mb-3">
									<label for="company_address" class="form-label">Company Address</label>
									<input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" value="{{ old('company_address', $professionalDetails->company_address ?? '') }}">
									@error('company_address')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Industry -->
								<div class="mb-3">
									<label for="industry" class="form-label">Industry</label>
									<input type="text" class="form-control @error('industry') is-invalid @enderror" id="industry" name="industry" value="{{ old('industry', $professionalDetails->industry ?? '') }}">
									@error('industry')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Designation -->
								<div class="mb-3">
									<label for="designation" class="form-label">Designation</label>
									<input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $professionalDetails->designation ?? '') }}">
									@error('designation')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<h3 class="mb-3">Educational Details</h3>
			<div class="w-100">
				@if ($educationalDetails)
					<div class="bg-white py-5 px-5 rounded">
						<input type="hidden" name="edu_id" value="{{ $educationalDetails->edu_id }}">
						<p>Qualification: <strong>{{ $educationalDetails->qualification }}</strong></p>
						<p>College Name: <strong>{{ $educationalDetails->college_name }}</strong></p>
						<p>Passing Year: <strong>{{ $educationalDetails->pass_year }}</strong></p>
						<p>College Address: <strong>{{ $educationalDetails->college_address }}</strong></p>
						<p class="mt-5">
							<a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editEducationalModal">
								<i class="far fa-edit me-2"></i> Update
							</a>
						</p>
					</div>
				@else
					<div class="bg-light py-5 px-5 rounded text-center">
						<p class="text-muted mb-0">No educational information available.</p>
					</div>
				@endif
			</div>

			<!-- Edit Educational Modal -->
			<div class="modal fade" id="editEducationalModal" tabindex="-1" aria-labelledby="editEducationalModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editEducationalModalLabel">Edit Educational Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						@if ($educationalDetails)
							<form action="{{ route('user.educational.update') }}" method="POST">
								@csrf
								<input type="hidden" name="edu_id" value="{{ $educationalDetails->edu_id }}">

								<!-- Qualification -->
								<div class="mb-3">
									<label for="qualification" class="form-label">Qualification</label>
									<input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" value="{{ old('qualification', $educationalDetails->qualification) }}">
									@error('qualification')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- College Name -->
								<div class="mb-3">
									<label for="college_name" class="form-label">College Name</label>
									<input type="text" class="form-control @error('college_name') is-invalid @enderror" id="college_name" name="college_name" value="{{ old('college_name', $educationalDetails->college_name) }}">
									@error('college_name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- Passing Year -->
								<div class="mb-3">
									<label for="pass_year" class="form-label">Passing Year</label>
									<input type="number" class="form-control @error('pass_year') is-invalid @enderror" id="pass_year" name="pass_year" value="{{ old('pass_year', $educationalDetails->pass_year) }}">
									@error('pass_year')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- College Address -->
								<div class="mb-3">
									<label for="college_address" class="form-label">College Address</label>
									<input type="text" class="form-control @error('college_address') is-invalid @enderror" id="college_address" name="college_address" value="{{ old('college_address', $educationalDetails->college_address) }}">
									@error('college_address')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						@else
							<div class="alert alert-warning">No education details available.</div>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<h3 class="mb-3">Documents' Details</h3>
			<div class="w-100">
				@if ($documents && count($documents) > 0)
					<div class="row">
						@foreach ($documents as $document)
							<div class="col-md-2 pt-2 me-3 bg-white">
								<h5>{{ucfirst($document->document_name) }}:</h5 >
								<p><a href="{{ Storage::url($document->file_path) }}" target="_blank">View</a> <span class="px-2">|</span> <a href="#" class="text-dark text-end" target="_blank">Replace</a></p>
							</div>
						@endforeach
					</div>
				@else
					<p>No documents available.</p>
				@endif

				<form action="{{ route('loan.update_documents') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div id="document-fields">
						<!-- Initially hidden document fields -->
					</div>
					<br>
					<div class="form-group mb-3">
						<button type="button" id="add-document" class="btn btn-primary">Add Missing Documents</button>
						<button type="submit" class="btn btn-success">Save Documents</button>
					</div>
				</form>
			</div>			
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script>
	document.getElementById('add-document').addEventListener('click', function() {
		var index = document.querySelectorAll('#document-fields .document-field').length;
		var newField = `
			<div class="document-field mb-3">
				<input type="text" name="documents[${index}][document_name]" class="form-control mb-2" placeholder="Document Name" required>
				<input type="file" name="documents[${index}][file]" class="form-control mb-2" required>
				<button type="button" class="btn btn-danger remove-document">Remove</button>
			</div>
		`;
		document.getElementById('document-fields').insertAdjacentHTML('beforeend', newField);
	});

	// Event delegation to handle removal of dynamically added fields
	document.getElementById('document-fields').addEventListener('click', function(e) {
		if (e.target.classList.contains('remove-document')) {
			e.target.parentElement.remove();
		}
	});
</script>
@endsection