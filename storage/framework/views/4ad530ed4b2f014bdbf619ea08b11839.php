

<?php $__env->startSection('title'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('title'); ?>
    JFS | Loan
<?php $__env->stopSection(); ?>

<link href="<?php echo e(asset('theme')); ?>/style.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="<?php echo e(asset('theme')); ?>/style.css" rel="stylesheet" />


<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <div class="container-fluid contact bg-light py-5">
        <div class="container mb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <div class="d-flex justify-content-center" >
                    <div class="contact-img-inner">
                        <img src="<?php echo e(asset('theme')); ?>/frontend/img/thank-you.png" class="img-fluid w-50"  alt="Image">
                    </div>
                </div>
                <!-- <p class="mb-0 mt-5">We have received your inquiry and will be in touch soon. We typically respond within 24 hours. If you wish to contact us sooner, feel free to contact us at: <a href="tel:918421216367">+91 84212 16367</a>.</p> -->
                <a class="btn-search btn btn-dark rounded-0 mt-4 py-3 px-4 px-md-5 me-2 flex-shrink-0" href="<?php echo e(url('/')); ?>/admin/dashboard">Back to Dashboard</a>
            </div>
        </div>
    </div>               
            
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinserv\resources\views/admin/thank-you.blade.php ENDPATH**/ ?>