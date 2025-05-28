<?php $__env->startSection('title'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
    JFS | Loan Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<!-- Breadcrumbs -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
            <li class="breadcrumb-item"><a href="<?php echo e(route('loans.index')); ?>">Loans List</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('loans.index')); ?>">All Loans</a></li>
            <li class="breadcrumb-item active" aria-current="page">Loan Details</li>
            </ol>
        </nav>
        <!-- Add User Button -->
         <div>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left-square me-2"></i> Back</a>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="bg-white">
    <?php if($loan): ?>
        <div class="row">
            <!-- Left side -->
            <div class="col-lg-8">
                <!-- Basic information -->
                <div class="card-body">
                    <h3 class="h4 mb-2"><strong>Basic Information</strong></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Loan Category</label>
                                <input type="text" class="form-control" value="<?php echo e($loan->loan_category_name ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Loan Amount</label>
                                <input type="text" class="form-control" value="<?php echo e($loan->amount ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Loan Tenure</label>
                                <input type="text" class="form-control" value="<?php echo e($loan->tenure ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Applied By</label>
                                <input type="text" class="form-control" value="<?php echo e($loan->user_name ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <?php if($profile): ?>
                <div class="card-body">
                    <h3 class="h4 mb-2"><strong>Profile Information</strong></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->mobile_no ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->dob ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Marital Status</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->marital_status ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Residence Address</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->residence_address ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->city ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->state ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="text" class="form-control" value="<?php echo e($profile->pincode ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Professional Information -->
                <?php if($professional): ?>
                <div class="card-body">
                    <h3 class="h4 mb-2"><strong>Professional Information</strong></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->company_name ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->designation ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Industry</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->industry ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Experience (Years)</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->experience_year ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Net Salary</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->netsalary ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Gross Salary</label>
                                <input type="text" class="form-control" value="<?php echo e($professional->gross_salary ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right side (if needed) -->
            <div class="col-lg-4 bg-light">
                <!-- Educational Information -->
                <?php if($education): ?>
                <div class="card-body">
                    <h3 class="h4 mb-2"><strong>Educational Information</strong></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" class="form-control" value="<?php echo e($education->qualification ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">College Name</label>
                                <input type="text" class="form-control" value="<?php echo e($education->college_name ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Pass Year</label>
                                <input type="text" class="form-control" value="<?php echo e($education->pass_year ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">College Address</label>
                                <input type="text" class="form-control" value="<?php echo e($education->college_address ?? 'N/A'); ?>" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Documents -->
                <?php if($documents): ?>
                <div class="card-body">
                    <h3 class="h4 mb-2"><strong>Documents</strong></h3>
                    <div class="row">
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-12 mb-3">
                                <label class="form-label"><?php echo e(ucfirst($document->document_name)); ?></label>
                                <input type="text" class="form-control" value="<?php echo e($document->file_path); ?>" readonly />
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php else: ?>
                    <p>No documents found.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <p>No loan details found.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/loan-details.blade.php ENDPATH**/ ?>