@extends('frontend.layouts.customer-dash')
@section('title', "My Profile")

@section('content')
<div class="container-fluid p-0">
	<h1 class="h3 mb-3"><strong>Welcome</strong> to Jfinserv</h1>
	<div class="row">
		<div class="col-xl-6">
			<div class="w-100">
				<div class="row">
					<div class="col-md-6">
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
								<h4 class="mt-1 mb-3">{{ $loanCount }}</h4>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
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
								<h4 class="mt-1 mb-3">{{ $disbursedLoanCount }}</h4>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
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
								<h4 class="mt-1 mb-3">₹{{ number_format($walletBalance, 2) }}</h4>
								<div class="mb-0">
									<span class="text-muted">Since last week</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Referral Code</h5>
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
								<h4 class="mt-1 mb-3">{{ $referralCode }}</h4>
								<div class="mb-0">
									<span class="text-muted">Share your referral code!</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			

		<div class="col-xl-6">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<h5 class="card-title mb-0">Total Earnings</h5>
				</div>
				<div class="card-body py-3">
					<div class="chart chart-sm">
						<canvas id="chartjs-dashboard-line"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
</div>
@endsection