@extends('frontend.layouts.customer-dash')
@section('title', "My Profile")

@section('content')
<div class="container-fluid p-0">
	<h1 class="h3 mb-3"><strong>Welcome</strong> to Jfinserv</h1>

	<div class="row">
		<div class="col-xl-12 d-flex">
			<div class="w-100">
				<div class="row">
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">My Loans</h5>
									</div>
									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="credit-card"></i>
										</div>
									</div>
								</div>
								<!-- Display the loan count dynamically -->
								<h1 class="mt-1 mb-3">{{ $loanCount }}</h1>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Disbursed Loans</h5>
									</div>
									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="users"></i>
										</div>
									</div>
								</div>
								<!-- Display the disbursed loan count dynamically -->
								<h1 class="mt-1 mb-3">{{ $disbursedLoanCount }}</h1>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Earnings</h5>
									</div>
									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="briefcase"></i>
										</div>
									</div>
								</div>
								<!-- Display the wallet balance dynamically -->
								<h1 class="mt-1 mb-3">₹{{ number_format($walletBalance, 2) }}</h1>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Referrals</h5>
									</div>
									<div class="col-auto">
										<!-- Share Icon with Dropdown -->
										<div class="dropdown">
											<a href="#" class="stat text-primary" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="align-middle" data-feather="share-2"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="https://wa.me/?text=Hi%2C%0AGood%20news%21%20You%27ve%20received%20a%20special%20referral%20code%20to%20unlock%20amazing%20benefits%20with%20JFinserv%0A%0AReferral%20Code%3A%20{{ $referralCode }}%0Ahttps%3A%2F%2Fjfs.digital%2F" target="_blank">
														Share via WhatsApp
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="mailto:?subject=Special%20Referral%20Code%20from%20JFinserv&body=Hi%2C%0A%0AGood%20news%21%20You%27ve%20received%20a%20special%20referral%20code%20to%20unlock%20amazing%20benefits%20with%20JFinserv%0A%0AReferral%20Code%3A%20{{ $referralCode }}%0Ahttps%3A%2F%2Fjfs.digital%2F" target="_blank">
														Share via Email
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!-- Display Referral Code -->
								<h4 class="mt-1 mb-3">Code: {{ $referralCode }}</h4>
								<div class="mb-0">
									<span class="text-muted">Share your referral code!</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection