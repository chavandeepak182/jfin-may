<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
Assigned Loans
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div style="">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="d-flex align-items-center">
                    <ol class="breadcrumb m-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Loans</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>User</th>
                            <th>Loan Category</th>
                            <th>Amount</th>
                            <th>Tenure</th>
                            <th>Agent Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loan->loan_reference_id); ?></td>
                                <td><?php echo e($loan->user->name ?? 'N/A'); ?></td>
                                <td><?php echo e($loan->loanCategory->category_name ?? 'N/A'); ?></td>
                                <td><?php echo e($loan->amount); ?></td>
                                <td><?php echo e($loan->tenure); ?></td>
                                <td><?php echo e(ucfirst($loan->agent_action) ?? 'Pending'); ?></td>
                                <td>
                                    <?php if($loan->agent_action == 'pending'): ?>
                                        <form action="<?php echo e(route('agent.acceptLoan')); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="loan_id" value="<?php echo e($loan->loan_id); ?>">
                                            <button type="submit" class="btn btn-success btn-xs">Accept</button>
                                        </form>
                                        <form action="<?php echo e(route('agent.rejectLoan')); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="loan_id" value="<?php echo e($loan->loan_id); ?>">
                                            <input type="text" name="remarks" placeholder="Enter remarks" required>
                                            <button type="submit" class="btn btn-danger btn-xs">Reject</button>
                                        </form>
                                    <?php elseif($loan->agent_action == 'accepted'): ?>
                                        <span class="badge bg-success">Accepted</span>
                                    <?php elseif($loan->agent_action == 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Loan ID</th>
                            <th>User</th>
                            <th>Loan Category</th>
                            <th>Amount</th>
                            <th>Tenure</th>
                            <th>Agent Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- Pagination controls handled by DataTables -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "ordering": true,
        });

        <?php if(session('success')): ?>
            Swal.fire({
                title: 'Success!',
                text: "<?php echo e(session('success')); ?>",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php elseif(session('error')): ?>
            Swal.fire({
                title: 'Error!',
                text: "<?php echo e(session('error')); ?>",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });

    // Define deleteLoan function
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
                    url: "<?php echo e(route('deleteLoan')); ?>",
                    method: "POST",
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>',
                        'loan_id': loanId,
                    },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Your loan has been deleted.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });
                    },
                    error: function (response) {
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/agent/assigned_loans.blade.php ENDPATH**/ ?>