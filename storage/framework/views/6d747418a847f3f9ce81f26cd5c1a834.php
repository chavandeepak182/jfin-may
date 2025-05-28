<?php $__env->startSection('title', "All Personal Details"); ?>

<?php $__env->startSection('content'); ?>
<div class="container p-0">
	<div class="row g-4">
		<div class="col-md-6">
			<h3 class="mb-3">Personal Details</h3>
			<div class="w-100">
				<?php if($profile): ?>
					<div class="bg-white py-5 px-5 rounded">
						<h4 class="m-0 text-primary"><strong><?php echo e($user->name); ?></strong></h4>
						<p><?php echo e($user->email_id); ?></p>
						<p class="m-0">Mobile No.: <strong><?php echo e($profile->mobile_no); ?></strong></p>
						<p>Gender: <strong><?php echo e($profile->gender); ?></strong> <span class="px-2">|</span> DOB: <strong><?php echo e($profile->dob); ?></strong> <span class="px-2">|</span> Marital Status: <strong><?php echo e($profile->marital_status); ?></strong></p>
						<p class="m-0">Residence: <strong><?php echo e($profile->residence_address); ?></strong></p>
						<p>City: <strong><?php echo e($profile->city); ?></strong> <span class="px-2">|</span> State: <strong><?php echo e($profile->state); ?></strong> <span class="px-2">|</span> Pincode: <strong><?php echo e($profile->pincode); ?></strong></p>
						<p class="mt-5"><a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="far fa-edit me-2"></i> Update</a></p>
					</div>
				<?php else: ?>
					<p>No personal information available.</p>
				<?php endif; ?>
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
							<form action="<?php echo e(route('user.profile.update')); ?>" method="POST">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">

								<!-- Name -->
								<div class="mb-3">
									<label for="name" class="form-label">Name</label>
									<input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>">
									<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Email ID -->
								<div class="mb-3">
									<label for="email_id" class="form-label">Email ID</label>
									<input type="email" class="form-control <?php $__errorArgs = ['email_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email_id" name="email_id" value="<?php echo e(old('email_id', $user->email_id)); ?>">
									<?php $__errorArgs = ['email_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Mobile No -->
								<div class="mb-3">
									<label for="mobile_no" class="form-label">Mobile No</label>
									<input type="text" class="form-control <?php $__errorArgs = ['mobile_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="mobile_no" name="mobile_no" value="<?php echo e(old('mobile_no', $profile->mobile_no)); ?>">
									<?php $__errorArgs = ['mobile_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="dob" class="form-label">Date of Birth</label>
									<input type="date" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="dob" name="dob" value="<?php echo e(old('dob', $profile->dob)); ?>">
									<?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="marital_status" class="form-label">Marital Status</label>
									<input type="text" class="form-control <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="marital_status" name="marital_status" value="<?php echo e(old('marital_status', $profile->marital_status)); ?>">
									<?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="residence_address" class="form-label">Residence Address</label>
									<input type="text" class="form-control <?php $__errorArgs = ['residence_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="residence_address" name="residence_address" value="<?php echo e(old('residence_address', $profile->residence_address)); ?>">
									<?php $__errorArgs = ['residence_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="city" class="form-label">City</label>
									<input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="city" name="city" value="<?php echo e(old('city', $profile->city)); ?>">
									<?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="state" class="form-label">State</label>
									<input type="text" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="state" name="state" value="<?php echo e(old('state', $profile->state)); ?>">
									<?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
								<div class="mb-3">
									<label for="pincode" class="form-label">Pincode</label>
									<input type="text" class="form-control <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pincode" name="pincode" value="<?php echo e(old('pincode', $profile->pincode)); ?>">
									<?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
				<?php if($professionalDetails): ?>
					<div class="bg-white py-5 px-5 rounded">
						<p>Designation: <strong><?php echo e($professionalDetails->designation); ?></strong></p>
						<p>Company Name: <strong><?php echo e($professionalDetails->company_name); ?></strong></p>
						<p>Years of Experience: <strong><?php echo e($professionalDetails->experience_year); ?> yrs</strong></p>
						<p>Company Address: <strong><?php echo e($professionalDetails->company_address); ?></strong></p>
						<p>Industry: <strong><?php echo e($professionalDetails->industry); ?></strong></p>
						<p class="mt-5">
							<a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfessionalModal">
								<i class="far fa-edit me-2"></i> Update
							</a>
						</p>
					</div>
				<?php else: ?>
					<p>No professional information available. Please add your details.</p>
				<?php endif; ?>
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
							<form action="<?php echo e(route('user.professional.update')); ?>" method="POST">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="professional_id" value="<?php echo e($professionalDetails->professional_id ?? ''); ?>">

								<!-- Profession Type -->
								<div class="mb-3">
									<label for="profession_type" class="form-label">Profession Type</label>
									<input type="text" class="form-control <?php $__errorArgs = ['profession_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="profession_type" name="profession_type" value="<?php echo e(old('profession_type', $professionalDetails->profession_type ?? '')); ?>">
									<?php $__errorArgs = ['profession_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Company Name -->
								<div class="mb-3">
									<label for="company_name" class="form-label">Company Name</label>
									<input type="text" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company_name" name="company_name" value="<?php echo e(old('company_name', $professionalDetails->company_name ?? '')); ?>">
									<?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Years of Experience -->
								<div class="mb-3">
									<label for="experience_year" class="form-label">Years of Experience</label>
									<input type="number" class="form-control <?php $__errorArgs = ['experience_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="experience_year" name="experience_year" value="<?php echo e(old('experience_year', $professionalDetails->experience_year ?? '')); ?>">
									<?php $__errorArgs = ['experience_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Company Address -->
								<div class="mb-3">
									<label for="company_address" class="form-label">Company Address</label>
									<input type="text" class="form-control <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company_address" name="company_address" value="<?php echo e(old('company_address', $professionalDetails->company_address ?? '')); ?>">
									<?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Industry -->
								<div class="mb-3">
									<label for="industry" class="form-label">Industry</label>
									<input type="text" class="form-control <?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="industry" name="industry" value="<?php echo e(old('industry', $professionalDetails->industry ?? '')); ?>">
									<?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Designation -->
								<div class="mb-3">
									<label for="designation" class="form-label">Designation</label>
									<input type="text" class="form-control <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="designation" name="designation" value="<?php echo e(old('designation', $professionalDetails->designation ?? '')); ?>">
									<?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
				<?php if($educationalDetails): ?>
					<div class="bg-white py-5 px-5 rounded">
						<input type="hidden" name="edu_id" value="<?php echo e($educationalDetails->edu_id); ?>">
						<p>Qualification: <strong><?php echo e($educationalDetails->qualification); ?></strong></p>
						<p>College Name: <strong><?php echo e($educationalDetails->college_name); ?></strong></p>
						<p>Passing Year: <strong><?php echo e($educationalDetails->pass_year); ?></strong></p>
						<p>College Address: <strong><?php echo e($educationalDetails->college_address); ?></strong></p>
						<p class="mt-5">
							<a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editEducationalModal">
								<i class="far fa-edit me-2"></i> Update
							</a>
						</p>
					</div>
				<?php else: ?>
					<div class="bg-light py-5 px-5 rounded text-center">
						<p class="text-muted mb-0">No educational information available.</p>
					</div>
				<?php endif; ?>
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
						<?php if($educationalDetails): ?>
							<form action="<?php echo e(route('user.educational.update')); ?>" method="POST">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="edu_id" value="<?php echo e($educationalDetails->edu_id); ?>">

								<!-- Qualification -->
								<div class="mb-3">
									<label for="qualification" class="form-label">Qualification</label>
									<input type="text" class="form-control <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="qualification" name="qualification" value="<?php echo e(old('qualification', $educationalDetails->qualification)); ?>">
									<?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- College Name -->
								<div class="mb-3">
									<label for="college_name" class="form-label">College Name</label>
									<input type="text" class="form-control <?php $__errorArgs = ['college_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="college_name" name="college_name" value="<?php echo e(old('college_name', $educationalDetails->college_name)); ?>">
									<?php $__errorArgs = ['college_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- Passing Year -->
								<div class="mb-3">
									<label for="pass_year" class="form-label">Passing Year</label>
									<input type="number" class="form-control <?php $__errorArgs = ['pass_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pass_year" name="pass_year" value="<?php echo e(old('pass_year', $educationalDetails->pass_year)); ?>">
									<?php $__errorArgs = ['pass_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<!-- College Address -->
								<div class="mb-3">
									<label for="college_address" class="form-label">College Address</label>
									<input type="text" class="form-control <?php $__errorArgs = ['college_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="college_address" name="college_address" value="<?php echo e(old('college_address', $educationalDetails->college_address)); ?>">
									<?php $__errorArgs = ['college_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						<?php else: ?>
							<div class="alert alert-warning">No education details available.</div>
						<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<h3 class="mb-3">Documents' Details</h3>
			<div class="w-100">
				<?php if($documents && count($documents) > 0): ?>
					<div class="row">
						<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-2 pt-2 me-3 bg-white">
								<h5><?php echo e(ucfirst($document->document_name)); ?>:</h5 >
								<p><a href="<?php echo e(Storage::url($document->file_path)); ?>" target="_blank">View</a> <span class="px-2">|</span> <a href="#" class="text-dark text-end" target="_blank">Replace</a></p>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php else: ?>
					<p>No documents available.</p>
				<?php endif; ?>

				<form action="<?php echo e(route('loan.update_documents')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.customer-dash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/profile/personal-info.blade.php ENDPATH**/ ?>