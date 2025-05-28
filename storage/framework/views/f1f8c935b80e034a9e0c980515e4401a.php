<?php $__env->startSection('title', "All Loan List"); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <!-- Filter Form -->
    <div class="row mt-3">
        <div class="col-md-10 mx-auto">
            <div class="row">
                <div class="col-md-8"><h2 class="mb-3">My Loan List</h2></div>
                <div class="col-md-4 mx-auto mb-3 float-end">
                    <form method="GET" action="<?php echo e(route('loans.loans-list')); ?>">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Filter by Status --</option>
                            <option value="approved" <?php echo e(request()->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                            <option value="rejected" <?php echo e(request()->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                            <option value="disbursed" <?php echo e(request()->status == 'disbursed' ? 'selected' : ''); ?>>Disbursed</option>
                            <option value="in process" <?php echo e(request()->status == 'in process' ? 'selected' : ''); ?>>In Process</option>
                        </select>
                    </form>
                </div>
            </div>
            <?php if($loans && count($loans) > 0): ?>
                <table class="table table-hover my-0 bg-white rounded-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-none d-xl-table-cell">Loan Reference ID</th>
                            <th class="d-none d-xl-table-cell">Amount</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Created At</th>
                            <th class="d-none d-md-table-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($loan->loan_reference_id); ?></td>
                                <td><?php echo e(number_format($loan->amount, 2)); ?></td>
                                <td><?php echo e(ucfirst($loan->status)); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($loan->created_at)->format('d-m-Y')); ?></td>

                                <td><a href="loanedit/<?php echo e($loan->loan_id); ?>">Edit</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No loans found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>                

<?php echo $__env->make('frontend.layouts.customer-dash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/profile/myloanlist.blade.php ENDPATH**/ ?>