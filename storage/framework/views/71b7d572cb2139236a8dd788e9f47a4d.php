<?php $__env->startSection('title'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
JFS | Agents
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<!-- Breadcrumbs and Search Bar -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Agents</li>
            </ol>
        </nav>

        <!-- Search Bar -->
        <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchUser()">
        </div>

        <!-- Add User Button -->
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addAgentView">
            <i class="fa fa-plus"></i> Add Agent
        </button>
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="<?php echo e(asset('theme')); ?>/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card pt-3">
            <div class="card-body">
                <div class="table-responsive" id="user_table">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Email ID </th>
                                <th> Mobile Number </th>
                                <th> DOB </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody id="user_table_body">
                            <?php $__currentLoopData = $data['allAgents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->id); ?></td>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email_id); ?></td>
                                <td><?php echo e($user->mobile_no); ?></td>
                                <td><?php echo e($user->dob); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs edit" title="Edit" href="<?php echo e(url('editUser/'.$user->id)); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a> 
                                    <button class="btn btn-danger btn-xs delete" title="Delete" data-id="<?php echo e($user->id); ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="float-right">
                        <?php echo e($data['allAgents']->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Agent Modal -->
<div class="modal fade" id="addAgentView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="addAgent" method="post">
                <?php echo csrf_field(); ?>   
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Email ID:</label>
                            <input type="email" class="form-control" id="email_id" name="email_id" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>    

                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Mobile Number:</label>
                            <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="tel" class="form-control" id="address" name="address">
                        </div>
                    </div>
   
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">State:</label>
                            <input type="text" class="form-control" id="state" name="state" >
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Pincode:</label>
                            <input type="text" class="form-control" id="pincode" name="pincode">
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Export Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize DataTable
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    // Attach click event to delete buttons dynamically
    $(document).on('click', '.delete', function () {
        var userId = $(this).data('id'); // Get user ID from button
        deleteAgent(userId);
    });

    // AJAX Setup to ensure CSRF Token is included
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle Add Agent Form Submission
    $('#addAgent').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo e(route('insertAgent')); ?>",
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status === 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                        swal("Error!", val[0], "error");
                    });
                } else {
                    $('#addAgent')[0].reset();
                    swal({
                        title: data.msg,
                        icon: "success",
                        button: "OK"
                    }).then(function () {
                        location.reload();
                    });
                }
            },
            error: function (xhr, status, error) {
                swal("Error!", "Something went wrong. Please try again.", "error");
            }
        });
    });
});

// Delete Agent Function
function deleteAgent(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this agent!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "<?php echo e(route('deleteAgent')); ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    'user_id': id,
                    '_token': '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    if (response.status === 0) {
                        swal("Error!", response.error, "error");
                    } else {
                        swal({
                            title: "Deleted!",
                            text: response.msg,
                            icon: "success",
                            button: "OK"
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    swal("Error!", "Failed to delete. Please try again.", "error");
                }
            });
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/agent/allAgents.blade.php ENDPATH**/ ?>