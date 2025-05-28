<?php $__env->startSection('title', "My Wallet"); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <h2 class="mb-3 text-center">My Wallet</h2>
    <div class="row">
        <div class="col-md-10 mx-auto d-flex">
            <div class="w-100">
                <div class="bg-white py-5 px-5 rounded">
                    <h4>Wallet Balance</h4>
                    <p>Your current wallet balance is: <strong>₹<?php echo e(number_format($walletBalance, 2)); ?></strong></p>

                    <!-- Withdrawal Form -->
                    <h4>Withdraw Funds</h4>
                    <form action="<?php echo e(route('user.withdraw.request')); ?>" method="POST" class="w-50">
                        <?php echo csrf_field(); ?>
                        <div class="form-group pb-4">
                            <label for="amount">Amount to Withdraw</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Request Withdrawal</button>
                    </form>

                    <!-- Display any success messages -->
                    <?php if(session('message')): ?>
                        <div class="alert alert-success mt-3">
                            <?php echo e(session('message')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Transaction History -->
                    <h4 class="mt-4">Transaction History</h4>
                    <div class="table-responsive">
                        <table id="transactionHistory" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>REFERRAL ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $combinedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($data->transaction_id ?? $data->id); ?></td>
                                        <td>₹<?php echo e(number_format($data->amount, 2)); ?></td>
                                        <td>
                                            <span class="<?php echo e($data->status == 'pending' ? 'text-warning' : ($data->status == 'completed' ? 'text-success' : '')); ?>">
                                                <?php echo e(ucfirst($data->status)); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($data->created_at)->format('d M Y, h:i A')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
<!-- DataTables and Export Buttons scripts -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('#transactionHistory').DataTable({
            processing: true,
            serverSide: false, // Since we are using static data, set to false
            paging: false, // Disable pagination as we're displaying all data
            searching: false, // Disable searching if not needed
            info: false, // Disable info display
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.customer-dash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/profile/referrals.blade.php ENDPATH**/ ?>