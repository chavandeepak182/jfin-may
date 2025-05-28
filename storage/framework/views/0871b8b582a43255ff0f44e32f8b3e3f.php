<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | User Management
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>

<!-- Breadcrumbs and Search Bar -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('allUsers')); ?>">All Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Custom styles for this page -->
<link href="<?php echo e(asset('theme')); ?>/dist-assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card pt-3">
            <div class="card-body">
                <form class="user" id="editUserView" method="post">
                <?php echo csrf_field(); ?>      
                <div class="">
                    <?php if(Session::has('error')): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo e(Session::get('error')); ?>               
                        </div>
                    <?php endif; ?>  

                    <?php $__currentLoopData = $data['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Full Name</label>
                                <input type="text" name="full_name" value="<?php echo e($u->name); ?>" class="form-control" required/>
                            </div> 
                                        
                            <div class="form-group col-lg-4">
                                <label>Email ID</label>
                                <input type="text" name="email_id" value="<?php echo e($u->email_id); ?>" class="form-control" required/>
                            </div> 
                            <div class="form-group col-lg-4">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_no" value="<?php echo e($u->mobile_no); ?>" class="form-control" required/>
                            </div> 
                        </div>    

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo e($u->dob); ?>" class="form-control" required/>
                            </div> 

                            <div class="form-group col-lg-4">
                                <label>Address</label>
                                <input type="text" name="address" value="<?php echo e($u->residence_address); ?>" class="form-control" required/>
                            </div> 

                            <div class="form-group col-lg-4">
                                <label>City</label>
                                <input type="text" name="city" value="<?php echo e($u->city); ?>" class="form-control" required/>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>State</label>
                                <input type="text" name="state" value="<?php echo e($u->state); ?>" class="form-control" required/>
                            </div> 

                            <div class="form-group col-lg-4">
                                <label>Pin Code</label>
                                <input type="text" name="pincode" value="<?php echo e($u->pincode); ?>" class="form-control" required/>
                            </div> 
                        </div>   
                                    
                        <input type="hidden" name="user_id" value="<?php echo $u->id; ?>"/> 
                        <div class="modal-footer">
                            <a class="btn btn-secondary" type="button" data-dismiss="modal" href="/admin/allUsers">Cancel</a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </form> 
            </div>
        </div>
    </div>
</div>    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>   
    $('#editUserView').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"<?php echo e(Route('updateUser')); ?>", 
            method:"POST",                             
            data:new FormData(this) ,
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){              
                if(data.status == 0){
                    $.each(data.error,function(prefix,val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });                      
                }else{
                    swal({
                        title: data.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){
                        window.location.href = "/admin/allUsers";
                    });
                        
                }
            }
        });
    }); 
 </script>


<!-- Page level plugins -->
<script src="<?php echo e(asset('theme')); ?>/dist-assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('theme')); ?>/dist-assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo e(asset('theme')); ?>/dist-assets/js/demo/datatables-demo.js"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/admin/editUser.blade.php ENDPATH**/ ?>