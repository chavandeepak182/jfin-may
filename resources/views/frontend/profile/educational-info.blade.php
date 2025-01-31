@extends('frontend.layouts.customer-dash')
@section('title', "All Educational Details")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Educational Information</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
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
		</div>						
	</div>
</div>        

<!-- Edit Educational Modal -->
<div class="modal fade" id="editEducationalModal" tabindex="-1" aria-labelledby="editEducationalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationalModalLabel">Edit Educational Information</h5>
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
@endsection