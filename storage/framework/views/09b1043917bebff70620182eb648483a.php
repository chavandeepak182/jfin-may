<?php $__env->startSection('content'); ?>
<!-- Lead Details Section -->
<div class="card shadow-sm">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">All Leads</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lead's Details</li>
                </ol>
            </nav>
            <a href="<?php echo e(route('leads.index')); ?>" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
            <!-- Search Bar -->
            <!-- <div class="d-flex ms-auto">
                <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchLead()">
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <!-- Lead Info Table -->
        <table class="table table-bordered table-striped">
            <tr>
                <th class="bg-light">Full Name</th>
                <td><?php echo e($lead->name); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Email</th>
                <td><?php echo e($lead->email); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Phone</th>
                <td><?php echo e($lead->phone); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Lead Source</th>
                <td><?php echo e($lead->lead_source); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Interested In</th>
                <td><?php echo e($lead->property_type); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Budget</th>
                <td><?php echo e($lead->budget_min); ?> - <?php echo e($lead->budget_max); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Lead Status</th>
                <td>
                    <span class="badge 
                        <?php if($lead->lead_status == 'New'): ?> badge-success 
                        <?php elseif($lead->lead_status == 'Contacted'): ?> badge-warning
                        <?php elseif($lead->lead_status == 'Closed'): ?> badge-danger 
                        <?php else: ?> badge-secondary <?php endif; ?>">
                        <?php echo e($lead->lead_status); ?>

                    </span>
                </td>
            </tr>
            <tr>
                <th class="bg-light">Assigned Agent</th>
                <td><?php echo e($lead->agent->name ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th class="bg-light">Notes</th>
                <td><?php echo e($lead->notes ?? 'No additional notes available'); ?></td>
            </tr>
        </table>

        <!-- Action Buttons -->
        <div class="mt-4">
            <a href="<?php echo e(route('leads.edit', $lead->id)); ?>" class="btn btn-warning  px-3 py-2 rounded">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form action="<?php echo e(route('leads.destroy', $lead->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger px-3 py-2 rounded" onclick="return confirm('Are you sure you want to delete this lead?')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/leads/show.blade.php ENDPATH**/ ?>