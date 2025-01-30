@extends('frontend.layouts.customer-dash')
@section('title', "All Personal Details")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Personal Information</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
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
		</div>						
	</div>
</div>
@extends('frontend.layouts.customer-dash')
@section('title', "All Personal Details")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Personal Information</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
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
		</div>						
	</div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
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
@endsection