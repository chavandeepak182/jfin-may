<?php $__env->startSection('title', 'Edit Loan'); ?>

<?php $__env->startSection('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('agent.allAgentLoans')); ?>">All Loans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Loan</li>
            </ol>
        </nav>
        <a href="<?php echo e(route('agent.allAgentLoans')); ?>" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="bg-white">
    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo e(session('success')); ?>',
            });
        </script>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>',
            });
        </script>
    <?php endif; ?>

    <form id="editLoanForm" method="post" action="<?php echo e(route('agent.updateLoan')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="loan_id" value="<?php echo e(old('loan_id', $loan->loan_id ?? '')); ?>">
        <div class="row">
            <!-- Left Section: Personal, Professional, Education & Loan Information -->
            <div class="col-md-8 px-5 py-3 mb-5"> <!-- Added pr-3 for padding -->
                <h3 class="h5 mb-3 mt-3"><strong>Loan Information</strong></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Loan Status:</label>
                            <select name="status" class="form-control" id="status" required onchange="toggleRemarkBox(this.value)">
                                <option value="in process" <?php echo e(old('status', $loan->status ?? '') == 'in process' ? 'selected' : ''); ?>>In Process</option>
                                <option value="document pending" <?php echo e(old('status', $loan->status ?? '') == 'document pending' ? 'selected' : ''); ?>>Document Pending</option>
                                <option value="disbursed" <?php echo e(old('status', $loan->status ?? '') == 'disbursed' ? 'selected' : ''); ?>>Disbursed</option>
                                <option value="approved" <?php echo e(old('status', $loan->status ?? '') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                <option value="rejected" <?php echo e(old('status', $loan->status ?? '') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
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
                    <!-- Remarks Box -->
                    <div class="col-md-12">
                        <div id="remarkBox" class="section mb-4" style="display: none;">
                            <h4 class="mb-3">Remark</h4>
                            <div class="form-group">
                                <label for="remarks">Remark:</label>
                                <textarea class="form-control" id="remarks" name="remarks"><?php echo e(old('remarks', $loan->remarks ?? '')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="approvedAmountBox" style="display: none;">
                        <div class="form-group">
                            <label for="amount_approved">Approved Amount:<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="amount_approved" name="amount_approved" value="<?php echo e(old('amount_approved', $loan->amount_approved ?? '')); ?>">
                        </div>
                    </div>
                    <!-- Sanction Letter (Visible only if status is 'approved') -->
                    <div class="col-md-12">
                        <div id="sanctionLetterBox" class="section mb-4" style="display: none;">
                            <h4 class="mb-3">Sanction Letter</h4>
                            <div class="form-group">
                                <label for="sanction_letter">Upload Sanction Letter:</label>
                                <input type="file" class="form-control" id="sanction_letter" name="sanction_letter">
                                <?php if($loan->sanction_letter): ?>
                                    <small>Current file: <a href="<?php echo e(asset('storage/sanction_letters/' . $loan->sanction_letter)); ?>" target="_blank"><?php echo e($loan->sanction_letter); ?></a></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount">Loan Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="<?php echo e(old('amount', $loan->amount ?? '')); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tenure">Loan Tenure:</label>
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
                </div>
                <!-- Personal Information -->
                <h3 class="h5 mb-3 mt-3"><strong>Personal Information</strong></h3>
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

                <!-- Professional Information -->
                <h3 class="h5 mb-3 mt-3"><strong>Professional Information</strong></h3>
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
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-warning rounded py-2 px-3"><strong>UPDATE LOAN</strong></button>
                </div>              
            </div>

            <!-- Right Section: Document Management -->
            <div class="col-md-4 py-2 px-5 bg-light">
                <div class="section mb-4">
                    <h3 class="h5 mb-3 mt-3"><strong>Loan Documents</strong></h3>
                    <div class="">
                        <!-- Existing Documents -->
                        <h6>Uploaded Documents:</h6>
                        <div class="row">
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12 mb-3">
                                <div class="document-wrapper">
                                    <a href="<?php echo e(asset('storage/documents/' . $doc->document_name)); ?>" target="_blank"><?php echo e($doc->document_name); ?></a> 
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
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
                </div>
                <!-- Education Information -->
                <div class="section mb-4">
                    <h3 class="h5 mb-3 mt-3"><strong>Education Information</strong></h3>
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
                                <input type="number" class="form-control" id="pass_year" name="pass_year" value="<?php echo e(old('pass_year', $education->pass_year ?? '')); ?>">
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
                                <textarea class="form-control" id="college_address" name="college_address"><?php echo e(old('college_address', $education->college_address ?? '')); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </form>
</div>

<!-- JavaScript for Document Upload Rows -->
<script>
    function addDocumentUploadRow() {
        const documentSection = document.getElementById('document-upload-section');
        const index = documentSection.querySelectorAll('.document-upload-row').length;

        const newRow = document.createElement('div');
        newRow.className = 'document-upload-row mb-3';
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-12 mb-2">
                    <input type="text" name="document_names[]" class="form-control" placeholder="Document Name">
                </div>
                <div class="col-md-12">
                    <input type="file" name="documents[]" class="form-control">
                </div>
            </div>
        `;

        documentSection.appendChild(newRow);
    }

    function toggleRemarkBox(status) {
    const remarkBox = document.getElementById('remarkBox');
    remarkBox.style.display = (status === 'approved' || status === 'rejected' || status === 'disbursed' || status === 'document pending') ? 'block' : 'none';

    // Show or hide the Approved Amount input field
    const approvedAmountBox = document.getElementById('approvedAmountBox');
    approvedAmountBox.style.display = (status === 'disbursed' || status === 'approved') ? 'block' : 'none';

    // Add or remove the 'required' attribute dynamically for client-side validation
    const approvedAmountInput = document.getElementById('amount_approved');
    if (status === 'disbursed') {
        approvedAmountInput.setAttribute('required', 'required');
    } else {
        approvedAmountInput.removeAttribute('required');
    }
}

function toggleSanctionLetterBox(status) {
    const sanctionLetterBox = document.getElementById('sanctionLetterBox');
    sanctionLetterBox.style.display = (status === 'approved') ? 'block' : 'none';
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

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/agent/edit-loan.blade.php ENDPATH**/ ?>