
<?php $__env->startSection('title'); ?>

<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | Activity Logs

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>


<style type="text/css">

    form fieldset{
        margin-left: 15px;
        margin-right: 15px;
        padding: 3%!important;
    }
    

</style>
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('partnerDashboard')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Loan</li>
    </ol>
</nav>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('theme')); ?>/frontend/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('theme')); ?>/frontend/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('theme')); ?>/frontend/scss/bootstrap/scss/_accordion.scss">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('theme')); ?>/frontend/scss/bootstrap/scss/_variables.scss">


<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

         <div style="padding: 1%"> 
            <h1><center>Create Loan</center></h1> 
                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Loan</h6>
                        </div>

                        <form action="<?php echo e(route('admin.handle_step')); ?>" method="POST" enctype="multipart/form-data" role="form" autocomplete="off" class="form">
                        <?php echo csrf_field(); ?>
                      
                            <fieldset>
                                <h4 class="text-primary mb-3">Personal Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="loan_category_id" id="loan_category" class="form-control" required>
                                                <option value="">Select Loan Category</option>
                                                <?php $__currentLoopData = $loanCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->loan_category_id); ?>" 
                                                        <?php echo e(old('loan_category_id', $loan->loan_category_id ?? '') == $category->loan_category_id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label for="loan_category">Loan Category <span class="text-danger">*</span></label>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="bank_id" id="bank_id" class="form-control" required>
                                                <option value="">Select Bank</option>
                                                <?php $__currentLoopData = $loanBanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($bank->bank_id); ?>" 
                                                        <?php echo e(old('bank_id', $loan->bank_id ?? '') == $bank->bank_id ? 'selected' : ''); ?>>
                                                        <?php echo e($bank->bank_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>

                                            <?php $__errorArgs = ['bank_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>    

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="phone" name="mobile_no" 
                                                value="<?php echo e(old('mobile_no', $profile->mobile_no ?? '')); ?>" placeholder="Phone" required>
                                            <label for="phone">Phone <span class="text-danger">*</span></label>

                                            <?php $__errorArgs = ['mobile_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="dob" name="dob" 
                                                value="<?php echo e(old('dob', $profile->dob ?? '')); ?>" placeholder="DOB" required>
                                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                            <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="marital_status" name="marital_status" required>
                                                <option value="" selected disabled hidden>Select Marital Status</option>
                                                <option value="Single" <?php echo e(old('marital_status', $profile->marital_status ?? '') == 'Single' ? 'selected' : ''); ?>>Single</option>
                                                <option value="Married" <?php echo e(old('marital_status', $profile->marital_status ?? '') == 'Married' ? 'selected' : ''); ?>>Married</option>
                                            </select>
                                            <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                                            <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="residence_address" name="residence_address" 
                                                value="<?php echo e(old('residence_address', $profile->residence_address ?? '')); ?>" placeholder="Address" required>
                                            <label for="residence_address">Address <span class="text-danger">*</span></label>
                                            <?php $__errorArgs = ['residence_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="state" name="state" required>
                                                <option value="">Select State <span class="text-danger">*</span></option>
                                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($state->id); ?>" <?php echo e(old('state', $profile->state ?? '') == $state->id ? 'selected' : ''); ?>>
                                                        <?php echo e($state->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label for="state">State <span class="text-danger">*</span></label>
                                            <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-control" id="city" name="city" required>
                                                <option value="">Select City</option>
                                                <?php if(isset($profile->city)): ?>
                                                    <option value="<?php echo e($profile->city); ?>" selected><?php echo e(optional(DB::table('cities')->where('id', $profile->city)->first())->city); ?></option>
                                                <?php endif; ?>
                                            </select>
                                            <label for="city">City</label>
                                            <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pincode" name="pincode" 
                                                value="<?php echo e(old('pincode', $profile->pincode ?? '')); ?>" placeholder="Pincode">
                                            <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                            <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                             <fieldset>
                                <h4 class="text-primary mb-3">Professional Details</h4>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input profession_type" type="radio" name="profession_type" id="salariedTab" value="salaried" checked 
                                                <?php echo e(old('profession_type', $professional->profession_type ?? '') == 'salaried' ? 'checked' : ''); ?>>
                                            <label for="salariedTab">Salaried Employees</label>
                                        </div>
                                        <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input profession_type" type="radio" name="profession_type" id="selfTab" value="self" 
                                                <?php echo e(old('profession_type', $professional->profession_type ?? '') == 'self' ? 'checked' : ''); ?>>
                                            <label for="selfTab">Self Employed/ Business Professionals</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-floating">
                                       <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo e(old('company_name', $professional->company_name ?? '')); ?>" placeholder="Company Name" required>
                                        </div>
                                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                         <input type="text" class="form-control" id="industry" name="industry" value="<?php echo e(old('industry', $professional->industry ?? '')); ?>" placeholder="Industry" required>
                                        <label for="industry">Nature of Business <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                      <div class="col-md-12">
                                        <div class="form-floating">
                                        <input type="text" class="form-control" id="company_address" name="company_address" value="<?php echo e(old('company_address', $professional->company_address ?? '')); ?>" placeholder="Company Address" required>
                                        <label for="company_address">Company Address <span class="text-danger">*</span></label>                                     
                                        </div>
                                        <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <input type="number" class="form-control" id="experience_year" name="experience_year" value="<?php echo e(old('experience_year', $professional->experience_year ?? '')); ?>" placeholder="Experience Year" required>
                                        <label for="experience_year">Experience Year <span class="text-danger">*</span></label>                                        
                                        </div>
                                        <?php $__errorArgs = ['experience_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e(old('designation', $professional->designation ?? '')); ?>" placeholder="Designation" required>
                                            <label for="designation">Designation <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-6" id="netsalary">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="netsalary" name="netsalary" value="<?php echo e(old('netsalary', $professional->netsalary ?? '')); ?>" placeholder="Net Salary" required>
                                            <label for="netsalary">Net Salary <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['netsalary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6" id="gross_salary">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="gross_salary" name="gross_salary" value="<?php echo e(old('gross_salary', $professional->gross_salary ?? '')); ?>" placeholder="Gross Salary" required>
                                           <label for="gross_salary">Gross Salary <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['gross_salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating" id="selfincome">
                                            <input type="number" class="form-control" id="selfincome" name="selfincome" value="<?php echo e(old('selfincome', $professional->selfincome ?? '')); ?>" placeholder="Total Income">
                                            <label for="selfincome">Total Income <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['selfincome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating" id="business_establish_date">
                                         <input type="date" class="form-control" id="business_establish_date" name="business_establish_date" 
                                                value="<?php echo e(old('business_establish_date', isset($professional->business_establish_date) ? \Carbon\Carbon::parse($professional->business_establish_date)->format('Y-m-d') : '')); ?>" 
                                                placeholder="Business Establish Date">
                                         <label for="business_establish_date">Business Establish Date <span class="text-danger">*</span></label>
                                        </div>
                                        <?php $__errorArgs = ['business_establish_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                   </div>
                            </fieldset>

                            <fieldset>
    <h4 class="text-primary mb-3">Qualification Details</h4>
    <div class="row g-3">
        
        <!-- Degree Dropdown (Qualification) -->
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" id="qualification" name="qualification" required>
                    <option value="">Select Degree</option>
                    <option value="Bachelors" <?php echo e(old('qualification', $education->qualification ?? '') == 'Bachelors' ? 'selected' : ''); ?>>Bachelors</option>
                    <option value="Masters" <?php echo e(old('qualification', $education->qualification ?? '') == 'Masters' ? 'selected' : ''); ?>>Masters</option>
                    <option value="PhD" <?php echo e(old('qualification', $education->qualification ?? '') == 'PhD' ? 'selected' : ''); ?>>PhD</option>
                    <option value="Other" <?php echo e(old('qualification', $education->qualification ?? '') == 'Other' ? 'selected' : ''); ?>>Other</option>
                </select>
                <label for="qualification">Highest Degree</label>
            </div> 
        </div>

        <!-- If "Other" is selected, show a text input to specify the qualification -->
        <div class="col-md-6" id="otherQualificationInput" style="display: none;">
            <div class="form-floating">
                <input type="text" class="form-control" id="other_qualification" name="other_qualification" value="<?php echo e(old('other_qualification', $education->other_qualification ?? '')); ?>" placeholder="Other Qualification">
            </div>
         <label for="other_qualification">Specify Other Degree</label>
        </div>

        <!-- Pass Year Dropdown -->
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" id="pass_year" name="pass_year" required>
                    <option value="">Select Year</option>
                    <?php for($year = date('Y'); $year >= 1980; $year--): ?>
                        <option value="<?php echo e($year); ?>" <?php echo e(old('pass_year', $education->pass_year ?? '') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                    <?php endfor; ?>
                </select>
                <label for="pass_year">Pass Year</label>
            </div>
        </div>

        <!-- College Name -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="college_name" name="college_name" value="<?php echo e(old('college_name', $education->college_name ?? '')); ?>" placeholder="College Name" required>
                <label for="college_name">College Name</label>
            </div>
        </div>

        <!-- College Address -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="college_address" name="college_address" value="<?php echo e(old('college_address', $education->college_address ?? '')); ?>" placeholder="College Address" required>
                <label for="college_address">College Address</label>
            </div>
        </div>

    </div>
</fieldset>

<fieldset>
                                <h4 class="text-primary">Upload Documents</h4>
                                <div class="row g-3">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    ID Proof
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body rounded">
                                                    <div class="row g-3">
                                                        <?php $__currentLoopData = ['aadhar_card', 'pancard', 'passport', 'driving_license']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                 
                                                                  
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                   
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                            <?php if($professional->profession_type=="salaried"): ?>
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Residence Proof
                                                </button>
                                            <?php else: ?>
                                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Business Proof
                                                  </button>
                                            <?php endif; ?>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body rounded">
                                                    <div class="row g-3">
                                                    <?php if($professional->profession_type=="salaried"): ?>

                                                        <?php $__currentLoopData = ['light_bill', 'dl', 'rent_agree']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                    <?php
                                                                        $existingDoc = $documents->firstWhere('document_name', $docType);
                                                                    ?>
                                                                    <?php if($existingDoc): ?>
                                                                        <a href="<?php echo e(Storage::url($existingDoc->file_path)); ?>" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                         <?php $__currentLoopData = ['rent_agreement', 'light_bill', 'business_license']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                   
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Income Proof
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                  

                                                        <?php $__currentLoopData = ['salary_slip', 'form_16']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                   
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                    
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                   
                                                    <?php $__currentLoopData = ['itr_with_tax_paid_challan', 'balance_sheet','bank_statement','bank_acount_statments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                   
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                   
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                  

                                         <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    Employment Proof
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                        <?php $__currentLoopData = ['offer_letter', 'hr_verification_letter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                   
                                                                   
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                    
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    Other Documents
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3">
                                                   
                                                        <?php $__currentLoopData = ['closure_letter', 'degree_certificate','propert_document','existing_loan_statment','saction_letter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                    <input type="file" id="<?php echo e($docType); ?>" name="<?php echo e($docType); ?>" class="form-control" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?>">
                                                                    <label for="<?php echo e($docType); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></label>
                                                                  
                                                                        <a href="" target="_blank">View Uploaded <?php echo e(ucfirst(str_replace('_', ' ', $docType))); ?></a>
                                                                   
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
    <h4 class="text-primary mb-3">Loan Details</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="number" step="0.01" name="amount" value="<?php echo e(old('amount', $loan->amount ?? '')); ?>" class="form-control" id="amount" placeholder="Amount" required>
                <label for="amount">Loan Amount</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select name="tenure" id="tenure" class="form-control" required>
                    <option value="">Select Tenure</option>
                    <?php for($i = 1; $i <= 30; $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e(old('tenure', $loan->tenure ?? '') == $i ? 'selected' : ''); ?>><?php echo e($i); ?> year<?php echo e($i > 1 ? 's' : ''); ?></option>
                    <?php endfor; ?>
                </select>
                <label for="tenure">Tenure (in years)</label>
            </div>
        </div>

        <!-- Referral Code Input -->
      
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" name="referral_code" value="<?php echo e(old('referral_code')); ?>" class="form-control" id="referral_code" placeholder="Referral Code">
                <label for="referral_code">Referral Code (Optional)</label>
            </div>
        </div>
       

        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" name="pan_number" value="<?php echo e(old('pan_number', $loan->pan_number ?? '')); ?>" class="form-control" id="pan_number" placeholder="PAN Number">
                <label for="pan_number">PAN Number</label>
            </div>
        </div>

       
    </div>
</fieldset>


<div class="col-md-12">
    <button name="next" class="btn btn-primary w-100 py-3" value="next" type="submit" id="submit-btn">
        Submit <i class="bi bi-arrow-right"></i>
    </button>
</div>
                        </form>

                

                        <div class="card-body">
                            <div class="table-responsive">
                         
                        </div>
                </div>
            </div>
        </div>

      


   
   

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>




<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<!-- <script>

$(document).ready( function () {
    $('#example').DataTable();
} );

</script> -->


<script>
   document.getElementById('state').addEventListener('change', function () {
    
    const stateId = this.value;
    const citySelect = document.getElementById('city');
    citySelect.innerHTML = '<option value="">Select City</option>';  // Reset options

    if (stateId) {
        fetch(`http://localhost/jfinserv/cities/${stateId}`)
            .then(response => response.json())
            .then(cities => {
                if (cities.length > 0) {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;  // ID of city
                        option.textContent = city.city;  // Name of city
                        citySelect.appendChild(option);
                    });
                } else {
                    citySelect.innerHTML = '<option value="">No cities available</option>';
                }
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
});
</script>


    
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const salariedTab = document.getElementById('salariedTab');
    const selfTab = document.getElementById('selfTab');
    const businessEstablishDate = document.getElementById('business_establish_date').closest('.col-md-6');
    const selfIncome = document.getElementById('selfincome').closest('.col-md-6');
    const netSalary = document.getElementById('netsalary').closest('.col-md-6');
    const grossSalary = document.getElementById('gross_salary').closest('.col-md-6');

    function toggleTextField() {
        if (selfTab.checked) {
            businessEstablishDate.classList.remove('d-none');
            selfIncome.classList.remove('d-none');
            netSalary.classList.add('d-none');
            grossSalary.classList.add('d-none');
        } else {
            businessEstablishDate.classList.add('d-none');
            selfIncome.classList.add('d-none');
            netSalary.classList.remove('d-none');
            grossSalary.classList.remove('d-none');
        }
    }

    salariedTab.addEventListener('change', toggleTextField);
    selfTab.addEventListener('change', toggleTextField);

    toggleTextField(); // Ensure correct fields are visible on page load
});

</script>









<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const qualificationSelect = document.getElementById('qualification');
    const otherQualificationInput = document.getElementById('otherQualificationInput');
    
    // Show or hide the "Other" input based on selection
    qualificationSelect.addEventListener('change', function() {
        if (qualificationSelect.value === 'Other') {
            otherQualificationInput.style.display = 'block';
        } else {
            otherQualificationInput.style.display = 'none';
        }
    });

    // Initial check for "Other" already selected (if coming from saved data)
    if (qualificationSelect.value === 'Other') {
        otherQualificationInput.style.display = 'block';
    }
});

</script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinserv\resources\views/admin/createLoan.blade.php ENDPATH**/ ?>