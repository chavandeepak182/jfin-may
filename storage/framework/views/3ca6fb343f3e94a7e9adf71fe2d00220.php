<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
Edit Loan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('loans.index')); ?>">All Loans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Loan</li>
            </ol>
        </nav>
        <!-- Add User Button -->
         <div>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left-square me-2"></i> Back</a>
        </div>
    </div>
</div>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>


<div class="bg-white">
    <form id="editLoanForm" method="post" action="<?php echo e(route('updateLoan')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="loan_id" value="<?php echo e(old('loan_id', $loan->loan_id ?? '')); ?>">

        <div class="row justify-content-between">
            <!-- Left Section: Personal, Professional, Education & Loan Information -->
            <div class="col-md-7 p-5">
                <!-- Personal Information -->
                <div class="section mb-4">
                    <h3 class="h4 mb-2"><strong>Personal Information</strong></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">User:</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo e($applyingUser->name ?? ''); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="loan_reference_id">Loan Id:</label>
                                <input type="text" class="form-control" id="loan_reference_id" name="loan_reference_id" value="<?php echo e(old('loan_reference_id', $loan->loan_reference_id ?? '')); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no">Mobile No:</label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo e(old('mobile_no', $profile->mobile_no ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="marital_status">Marital Status:</label>
                                <select class="form-control" id="marital_status" name="marital_status">
                                    <option value="single" <?php echo e(old('marital_status', $profile->marital_status ?? '') == 'single' ? 'selected' : ''); ?>>Single</option>
                                    <option value="married" <?php echo e(old('marital_status', $profile->marital_status ?? '') == 'married' ? 'selected' : ''); ?>>Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e(old('dob', $profile->dob ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="residence_address">Residence Address:</label>
                                <textarea class="form-control" id="residence_address" name="residence_address"><?php echo e(old('residence_address', $profile->residence_address ?? '')); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?php echo e(old('city', $profile->city ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" id="state" name="state" value="<?php echo e(old('state', $profile->state ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pincode">Pincode:</label>
                                <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo e(old('pincode', $profile->pincode ?? '')); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="section mb-4">
                    <h3 class="h4 mb-2"><strong>Professional Information</strong></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name:</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo e(old('company_name', $professional->company_name ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industry">Industry:</label>
                                <input type="text" class="form-control" id="industry" name="industry" value="<?php echo e(old('industry', $professional->industry ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_address">Company Address:</label>
                                <textarea class="form-control" id="company_address" name="company_address"><?php echo e(old('company_address', $professional->company_address ?? '')); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="experience_year">Experience Year:</label>
                                <input type="number" class="form-control" id="experience_year" name="experience_year" value="<?php echo e(old('experience_year', $professional->experience_year ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e(old('designation', $professional->designation ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="net_salary">Net Salary:</label>
                                <input type="number" class="form-control" id="net_salary" name="netsalary" value="<?php echo e(old('netsalary', $professional->netsalary ?? '')); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loan Information -->
                <div class="section mb-4">
                    <h3 class="h4 mb-2"><strong>Loan Information</strong></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Loan Status:</label>
                                <select name="status" class="form-control" id="status" required onchange="toggleRemarkBox(this.value)">
                                    <option value="approved" <?php echo e(old('status', $loan->status ?? '') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                    <option value="rejected" <?php echo e(old('status', $loan->status ?? '') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                    <option value="in process" <?php echo e(old('status', $loan->status ?? '') == 'in process' ? 'selected' : ''); ?>>In Process</option>
                                    <option value="disbursed" <?php echo e(old('status', $loan->status ?? '') == 'disbursed' ? 'selected' : ''); ?>>Disbursed</option>
                                    <option value="document pending" <?php echo e(old('status', $loan->status ?? '') == 'document pending' ? 'selected' : ''); ?>>Document Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="loan_category_id">Loan Category:</label>
                                <select name="loan_category_id" class="form-control" required>
                                    <?php $__currentLoopData = $loanCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->loan_category_id); ?>" <?php echo e(old('loan_category_id', $loan->loan_category_id ?? '') == $category->loan_category_id ? 'selected' : ''); ?>>
                                            <?php echo e($category->category_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="<?php echo e(old('amount', $loan->amount ?? '')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tenure">Tenure:</label>
                                <input type="number" class="form-control" id="tenure" name="tenure" value="<?php echo e(old('tenure', $loan->tenure ?? '')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tenure">Tentative Approval</label>
                                <select name="in_principle" id="in_principle" class="form-control">
                                    <option value="Yes" <?php echo e($loan->in_principle == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                                    <option value="No" <?php echo e($loan->in_principle == 'No' ? 'selected' : ''); ?>>No</option>
                                </select>                            
                            </div>
                        </div>
                        <!-- Sanction Letter (Visible only if status is 'approved') -->
                        <div class="col-md-6">
                            <div id="sanctionLetterBox" class="section mb-4" style="display: none;">
                                <h3 class="h4 mb-2"><strong>Sanction Letter</strong></h4>
                                <div class="form-group">
                                    <label for="sanction_letter">Upload Sanction Letter:</label>
                                    <input type="file" class="form-control" id="sanction_letter" name="sanction_letter">
                                    <?php if($loan->sanction_letter): ?>
                                        <small>Current file: <a href="<?php echo e(asset('storage/sanction_letters/' . $loan->sanction_letter)); ?>" target="_blank"><?php echo e($loan->sanction_letter); ?></a></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="remark-box" style="display: none;">
                    <label for="remark">Remark:</label>
                    <textarea class="form-control" id="remark" name="remarks"><?php echo e(old('remarks')); ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 py-3 rounded"><strong>UPDATE LOAN</strong></button>
                </div>
            </div>

            <!-- Right Section: Documents -->
            <div class="col-md-4 bg-light p-5">
                <div class="section mb-4">
                    <h3 class="h4 mb-2"><strong>Documents</strong></h4>
                    <!-- Documents -->
                    <h6>Uploaded:</h6>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12 mb-3">
                        <div class="document-wrapper">
                            <a href="<?php echo e(asset('storage/documents/' . $doc->document_name)); ?>" target="_blank"><?php echo e($doc->document_name); ?></a>
                            
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Document Upload -->
                    <h6>Upload New Documents:</h6>
                    <div id="document-upload-section">
                        <div class="document-upload-row mb-3">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <input type="text" name="document_name[]" class="form-control" placeholder="Document Name">
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="documents[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addDocumentUploadRow()">Add Another Document</button>
                </div>

                <!-- Education Information -->
                <div class="section mb-4 mt-5">
                    <h3 class="h4 mb-2"><strong>Education Information</strong></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">Qualification:</label>
                                <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo e(old('qualification', $education->qualification ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass_year">Passing Year:</label>
                                <input type="text" class="form-control" id="pass_year" name="pass_year" value="<?php echo e(old('pass_year', $education->pass_year ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="college_name">College Name:</label>
                                <input type="text" class="form-control" id="college_name" name="college_name" value="<?php echo e(old('college_name', $education->college_name ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="college_address">College Address:</label>
                                <input type="text" class="form-control" id="college_address" name="college_address" value="<?php echo e(old('college_address', $education->college_address ?? '')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle form submission with AJAX
        $('#editLoanForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
    url: $(this).attr('action'),
    method: 'POST',
    data: $(this).serialize(), // Serialize form data
    success: function(response) {
    console.log(response); // Inspect the response object
    Swal.fire({
        title: response.msg || 'Success!', // Fallback to 'Success!' if msg is not present
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo e(route('loans.index')); ?>"; // Redirect to the loans index
        }
    });
    },
    error: function(response) {
        Swal.fire({
            title: 'Error!',
            text: 'Something went wrong!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});
        });
    });
</script>
<script>
    function toggleRemarkBox(value) {
        var remarkBox = document.getElementById('remark-box');
        if (value === 'rejected' || value === 'approved' || value === 'in process' || value === 'disbursed') {
            remarkBox.style.display = 'block';
        } else {
            remarkBox.style.display = 'none';
        }
    }

    function addDocumentUploadRow() {
        var documentUploadSection = document.getElementById('document-upload-section');
        var newRow = document.createElement('div');
        newRow.className = 'document-upload-row mb-3';
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-12 mb-2">
                    <input type="text" name="document_name[]" class="form-control" placeholder="Document Name">
                </div>
                <div class="col-md-12">
                    <input type="file" name="documents[]" class="form-control">
                </div>
            </div>
        `;
        documentUploadSection.appendChild(newRow);
    }
    function toggleSanctionLetterBox(status) {
    document.getElementById('sanctionLetterBox').style.display = (status === 'approved') ? 'block' : 'none';
}

// Initialize the form based on current status
document.addEventListener('DOMContentLoaded', function() {
    var status = document.getElementById('status') ? document.getElementById('status').value : '';
    toggleSanctionLetterBox(status);
});

// Listen for changes in the loan status
document.getElementById('status').addEventListener('change', function() {
    toggleSanctionLetterBox(this.value);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinserv\resources\views/admin/edit-loan.blade.php ENDPATH**/ ?>