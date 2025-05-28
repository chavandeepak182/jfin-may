<li>
    <a href="#" class="node"><?php echo e($node['name']); ?></a>
    <?php if(!empty($node['children'])): ?>
        <ul>
            <?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('admin.tree_node', ['node' => $child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</li>
<?php /**PATH C:\xampp\htdocs\jfinserv\resources\views/admin/tree_node.blade.php ENDPATH**/ ?>