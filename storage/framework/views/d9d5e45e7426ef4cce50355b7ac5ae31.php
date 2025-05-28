<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | Activity Logs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('partnerDashboard')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
    </ol>
</nav>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

         <div style="padding: 1%"> 
            <h1><center>All Activity Logs</center></h1> 
                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Activity Logs</h6>
                        </div>
                

                        <div class="card-body">
                            <div class="table-responsive" id="user_table">
                         
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Activity Details</th>
                                        <th>Activity User Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $__currentLoopData = $data['allActivies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td>
                                                <?php echo e($p->id); ?>

                                            </td>   
                                            <td>
                                                <?php echo e($p->activity_details); ?>

                                            </td>  
                                            <td>
                                                <?php echo e($p->name); ?>

                                            </td> 
                                            
                                         
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                  
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Activity Details</th>
                                        <th>Activity User Name</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="float-right"> 
                                <?php echo e($data['allActivies']->links()); ?>

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
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinmate\resources\views/admin/activityLogs.blade.php ENDPATH**/ ?>