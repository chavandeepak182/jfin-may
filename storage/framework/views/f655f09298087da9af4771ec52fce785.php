<?php $__env->startSection('title', "My Loans"); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">My Loans</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
			<div class="w-100">
				<?php if($loans->isNotEmpty()): ?>
					<div class="accordion" id="loanAccordion">
						<?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="accordion-item mb-3 rounded-0 shadow">
								<h2 class="accordion-header" id="heading<?php echo e($loan->loan_reference_id); ?>">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($loan->loan_reference_id); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($loan->loan_reference_id); ?>">
										<b>Loan ID: </b> <?php echo e($loan->loan_reference_id); ?> <span class="px-3">|</span> <b>Status: </b> <?php echo e($loan->status); ?>

									</button>
								</h2>
								<div id="collapse<?php echo e($loan->loan_reference_id); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo e($loan->loan_reference_id); ?>" data-bs-parent="#loanAccordion">
									<div class="accordion-body loan-tracking-container py-5">
										<article class="card">
											<header class="card-header"> Loan Tracking </header>
											<div class="card-body">
												<h6>Loan Reference ID: <?php echo e($loan->loan_reference_id); ?></h6>
												<article class="card">
													<div class="card-body row">
														<div class="col"> <strong>Status:</strong> <br> <?php echo e(ucfirst($loan->status)); ?> </div>
														<div class="col"> <strong>Last Updated:</strong> <br> <?php echo e(\Carbon\Carbon::parse($loan->updated_at)->format('d M, Y')); ?> </div>
													</div>
												</article>

												<!-- Tracking Progress -->
												<div class="track">
													<?php
														// Define the steps for each status
														$statuses = [
																'in process', 'approved', 'rejected', 'disbursed'
														];

														// Initialize the steps to display
														$stepsToShow = ['loan submitted']; // Always show this step

														// Determine which additional steps to show based on the loan status
														if ($loan->status == 'approved') {
															$stepsToShow = array_merge($stepsToShow, ['in process', 'approved', 'rejected', 'disbursed']);
														} elseif ($loan->status == 'disbursed') {
															$stepsToShow = array_merge($stepsToShow, ['in process', 'approved', 'disbursed']);
														} elseif ($loan->status == 'in process') {
															$stepsToShow = array_merge($stepsToShow, ['in process']);
														} elseif ($loan->status == 'rejected') {
															$stepsToShow = array_merge($stepsToShow, ['in process', 'rejected']);
														} else {
															$stepsToShow = array_merge($stepsToShow, $statuses);
														}

														// Determine the index of the current status
														$currentStatusIndex = array_search($loan->status, $statuses);
													?>

													<?php $__currentLoopData = $stepsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="step <?php echo e($index <= $currentStatusIndex ? 'active' : ''); ?>">
															<span class="icon">
																<i class="fa <?php echo e($status == 'rejected' ? 'fa-times' : 'fa-check'); ?>"></i>
															</span>
															<span class="text"><?php echo e(ucfirst($status)); ?></span>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</div>
											</div>
										</article>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php else: ?>
					<p>No loan information available.</p>
				<?php endif; ?>
			</div>
		</div>						
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.customer-dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jfinserv\resources\views/frontend/profile/all-loans.blade.php ENDPATH**/ ?>