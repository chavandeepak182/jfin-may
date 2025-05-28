

<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
All Loans
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">MIS Dashboard</li>
                </ol>
            </nav>
        </div>

       <!--  <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchMIS()">
        </div>
 -->
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#addMISView" style="    float: inline-end;">
            <i class="fa fa-plus"></i> Add Mis
        </button>

       <form method="GET" action="<?php echo e(route('mis.index')); ?>" class="mt-4 mb-3">
            <div class="row justify-content-space-between">
               
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('mis.index')); ?>" class="btn btn-secondary ms-2">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="loansTable" class="table" style="width:100%">
                <thead>
                    <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Product Type</th>
                                <th>Amount</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                </thead>
                <tbody>
                   <?php $__currentLoopData = $misRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($mis->id); ?></td>
                                <td><?php echo e($mis->name); ?></td>
                                <td><?php echo e($mis->email); ?></td>
                                <td><?php echo e($mis->contact); ?></td>
                                <td><?php echo e($mis->product_type); ?></td>
                                <td><?php echo e($mis->amount); ?></td>
                                <td><?php echo e($mis->city); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs edit" title="Edit" href="<?php echo e(route('mis.edit', $mis->id)); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteRecord('<?php echo e($mis->id); ?>')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                     <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Product Type</th>
                                <th>Amount</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                </tfoot>
            </table>
            <div class="float-right"> 
                        <?php echo e($misRecords->links()); ?>

            </div>
        </div>
    </div>
</div>

<!-- Add MIS Record Modal -->
<div class="modal fade" id="addMISView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMISRecord" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="contact" class="col-form-label">Contact:</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="office_contact" class="col-form-label">Office Contact:</label>
                            <input type="text" class="form-control" id="office_contact" name="office_contact" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="product_type" class="col-form-label">Product Type:</label>
                            <select class="form-control" id="product_type" name="product_type" required>
                                <option value="">Select Product Type</option>
                                <option value="Home Loan">Home Loan</option>
                                <option value="Personal Loan">Personal Loan</option>
                                <option value="MSME">MSME</option>
                                <option value="Vehicle Loan">Vehicle Loan</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="occupation" class="col-form-label">Occupation:</label>
                            <select class="form-control" id="occupation" name="occupation" required>
                                <option value="">Select Occupation</option>
                                <option value="Salaried" <?php echo e(old('occupation', $misRecord->occupation ?? '') == 'Salaried' ? 'selected' : ''); ?>>Salaried</option>
                                <option value="Self Employed" <?php echo e(old('occupation', $misRecord->occupation ?? '') == 'Self Employed' ? 'selected' : ''); ?>>Self Employed</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="bank_name" class="col-form-label">Bank Name:</label>
                            <select class="form-control" id="bank_name" name="bank_name" required>
                                <option value="">Select Bank Name</option>
                                <option value="IDFC" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'IDFC' ? 'selected' : ''); ?>>IDFC</option>
                                <option value="SBI" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'SBI' ? 'selected' : ''); ?>>SBI</option>
                                <option value="KOTAK" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'KOTAK' ? 'selected' : ''); ?>>KOTAK</option>
                                <option value="HDFC" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'HDFC' ? 'selected' : ''); ?>>HDFC</option>
                                <option value="MAHARASHTRA" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'MAHARASHTRA' ? 'selected' : ''); ?>>MAHARASHTRA</option>
                                <option value="AXIS" <?php echo e(old('bank_name', $misRecord->bank_name ?? '') == 'AXIS' ? 'selected' : ''); ?>>AXIS</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="branch_name" class="col-form-label">Branch Name:</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="amount" class="col-form-label">Amount:</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="city" class="col-form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="address" class="col-form-label">Residencial Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="office_address" class="col-form-label">Office Address:</label>
                            <textarea class="form-control" id="office_address" name="office_address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized
        if (!$.fn.DataTable.isDataTable('#loansTable')) {
            // Initialize DataTable with export buttons
            $('#loansTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        title: 'Loans Data'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Loans Data'
                    }
                ]
            });
        }

        // Handling the form submission (Example AJAX for adding loan)
        $('#addLoanForm').on('submit', function(e) {
            e.preventDefault();
            // Add AJAX request for form submission
            $.ajax({
                url: '/path-to-submit-loan',  // Change with the actual URL for submission
                method: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success (e.g., show a success message or update the table)
                    alert('Loan added successfully!');
                    // Optionally, reload the table after submission (if needed)
                    reloadLoansTable();
                },
                error: function(response) {
                    // Handle error (e.g., show an error message)
                    alert('Error adding loan!');
                }
            });
        });
    });

    // Delete loan function with confirmation
    function deleteLoan(loanId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo e(route('deleteLoan')); ?>",  // Adjust the route for deletion
                    method: "POST",
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>',
                        'loan_id': loanId,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your loan has been deleted.',
                            'success'
                        ).then(function() {
                            // Optionally reload table after deletion
                            reloadLoansTable();
                        });
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the loan.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    // Function to reload DataTable (after AJAX updates)
    function reloadLoansTable() {
        // Destroy current DataTable instance
        var table = $('#loansTable').DataTable();
        table.clear().destroy(); // Clears existing data and destroys current DataTable instance
        
        // Reinitialize DataTable
        $('#loansTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Loans Data'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'Loans Data'
                }
            ]
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinmate\resources\views/mis/index.blade.php ENDPATH**/ ?>