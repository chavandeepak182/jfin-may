@extends('frontend.layouts.customer-dash')
@section('title', "My Loans")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">My Loans</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
			<div class="w-100">
				@if ($loans->isNotEmpty())
					<div class="accordion" id="loanAccordion">
						@foreach ($loans as $loan)
							<div class="accordion-item mb-3 rounded-0 shadow">
								<h2 class="accordion-header" id="heading{{ $loan->loan_reference_id }}">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loan->loan_reference_id }}" aria-expanded="false" aria-controls="collapse{{ $loan->loan_reference_id }}">
										<b>Loan ID: </b> {{ $loan->loan_reference_id }} <span class="px-3">|</span> <b>Status: </b> {{ $loan->status }}
									</button>
								</h2>
								<div id="collapse{{ $loan->loan_reference_id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loan->loan_reference_id }}" data-bs-parent="#loanAccordion">
									<div class="accordion-body loan-tracking-container py-5">
										<article class="card">
											<header class="card-header"> Loan Tracking </header>
											<div class="card-body">
												<h6>Loan Reference ID: {{ $loan->loan_reference_id }}</h6>
												<article class="card">
													<div class="card-body row">
														<div class="col"> <strong>Status:</strong> <br> {{ ucfirst($loan->status) }} </div>
														<div class="col"> <strong>Last Updated:</strong> <br> {{ \Carbon\Carbon::parse($loan->updated_at)->format('d M, Y') }} </div>
													</div>
												</article>

												<!-- Tracking Progress -->
												<div class="track">
													@php
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
													@endphp

													@foreach ($stepsToShow as $index => $status)
														<div class="step {{ $index <= $currentStatusIndex ? 'active' : '' }}">
															<span class="icon">
																<i class="fa {{ $status == 'rejected' ? 'fa-times' : 'fa-check' }}"></i>
															</span>
															<span class="text">{{ ucfirst($status) }}</span>
														</div>
													@endforeach
												</div>
											</div>
										</article>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<p>No loan information available.</p>
				@endif
			</div>
		</div>						
	</div>
</div>
@endsection