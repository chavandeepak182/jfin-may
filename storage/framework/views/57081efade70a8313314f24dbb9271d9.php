<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | Disbursed Loans
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Stylesheets for DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Disbursed Loans</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="user_table">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>User Name</th>
                        <th>Loan Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data['loans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loan->loan_reference_id); ?></td>
                        <td><?php echo e($loan->amount); ?></td>
                        <td><?php echo e($loan->tenure); ?></td>
                        <td><?php echo e($loan->user_name); ?></td>
                        <td><?php echo e($loan->category_name); ?></td> <!-- Correct column for loan category -->
                        <td>
                            <a class="btn btn-primary btn-xs view" title="View" href="<?php echo e(route('loan.view', ['id' => $loan->loan_id])); ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-primary btn-xs edit" title="Edit" href="<?php echo e(route('editLoan', ['id' => $loan->loan_id])); ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteLoan('<?php echo e($loan->loan_id); ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Loan ID</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>User Name</th>
                        <th>Loan Category</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <div class="float-right"> 
                <?php echo e($data['loans']->links()); ?>

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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});

function deleteLoan(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this loan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "<?php echo e(route('deleteLoan')); ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    'loan_id': id,
                    '_token': '<?php echo e(csrf_token()); ?>',
                },
                success: function (response) {
                    if (response.status == 0) {
                        swal("Deleted!", response.msg, "success").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("Error!", response.msg, "error");
                    }
                }
            });
        }
    });
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/disbursed_loans.blade.php ENDPATH**/ ?>