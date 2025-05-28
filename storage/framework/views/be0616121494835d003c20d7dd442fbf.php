<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | Referral 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Referral Earnings</li>
    </ol>
</nav>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

         <div style="padding: 1%"> 
            <h1><center>All Users Referral Earnings</center></h1> 
                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Referral Users List</h6>
                        </div>
                

                        <div class="card-body">
                            <div class="table-responsive" id="user_table">
                         
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Referral Code</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $__currentLoopData = $data['earnings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($user->referral_code); ?>

                                            </td>   
                                            <td>
                                                <?php echo e($user->name); ?>

                                            </td>  
                                            <td>
                                                <?php echo e($user->email_id); ?>

                                            </td> 
                                            <td>
                                                <?php echo e($user->mobile_no); ?>

                                            </td> 
                                            <td>
                                                <?php echo e($user->wallet_balance); ?>

                                            </td> 
                                            <td>
                                                 <?php echo e($user->dob); ?>

                                            </td> 
                                           
                                            <td>
                                                <a class="btn btn-primary btn-xs edit" title="Edit"href="#"><i class="fa fa-eye"></i></a> 
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                  
                                <tfoot>
                                    <tr>
                                        <th>Referral Code</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th> 
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="float-right"> 
                                <?php echo e($data['earnings']->links()); ?>

                            </div>
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
<script>

$(document).ready( function () {
    $('#example').DataTable();
} );

</script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/admin/earnings.blade.php ENDPATH**/ ?>