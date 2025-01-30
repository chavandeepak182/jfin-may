@extends('frontend.layouts.customer-dash')
@section('title', "All Professional Details")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Professional Details</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
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
		</div>
	</div>
</div>

<!-- Edit Professional Modal -->
<div class="modal fade" id="editProfessionalModal" tabindex="-1" aria-labelledby="editProfessionalModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editProfessionalModalLabel">Edit Professional Information</h5>
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
@endsection