<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="{{ asset('theme') }}/user-dash/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        
     
.loan-tracking-container .track {
    background-color: #ddd;
    height: 7px;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px;
    position: relative; /* Add this */
    z-index: 1; /* Ensure the line is below the icons */
}

.loan-tracking-container .step {
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative;
}

.loan-tracking-container .step.active:before {
    background: #FF5722;
}

.loan-tracking-container .step:before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px;
}

.loan-tracking-container .step.active .icon {
    background: #ee5435;
    color: #fff;
    z-index: 10; /* Bring the icon above the line */
    position: relative; /* Ensure the icon is positioned relative to its step */
}

.loan-tracking-container .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 100%;
    background: #ddd;
    z-index: 10; /* Ensure the icon is above the line */
    position: relative; /* Position relative to allow z-index to take effect */
}

.loan-tracking-container .step.active .text {
    font-weight: 400;
    color: #000;
}

.loan-tracking-container .text {
    display: block;
    margin-top: 7px;
}

    </style>
</head>

<body>
	<div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ asset('') }}">
					<span class="align-middle"><img style="background-color: white;" width="100%" height="50px" src="{{ asset('theme/logo.png') }}"></span>
				</a>

				<ul class="sidebar-nav">
					<!-- Dashboard Link -->
					<li class="sidebar-item">
						<a class="sidebar-link" href="/my-profile">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<!-- My Loans Dropdown -->
					<li class="sidebar-item">
						<a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#loan-dropdown" aria-expanded="false">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">My Loans <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="loan-dropdown" >
							<li class="sidebar-item active"><a class="sidebar-link" href="{{ route('loan.myloans') }}">Track Loan</a></li>
							<li><a class="sidebar-link" href="{{ route('loans.loans-list') }}">Total Loans</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('user.childNodes') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">LegDown</span>
                        </a>
					</li> 	

					<!-- My Details Dropdown -->
					<li class="sidebar-item">
						<a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#details-dropdown" aria-expanded="false">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">My Details <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="details-dropdown">
							<li><a class="sidebar-link" href="{{ route('loan.mypersonal') }}">Personal Information</a></li>
							<li><a class="sidebar-link" href="{{ route('loan.myprofessional') }}">Professional Information</a></li>
							<li><a class="sidebar-link" href="{{ route('loan.myeducation') }}">Educational Information</a></li>
							<li><a class="sidebar-link" href="{{ route('loan.mydocuments') }}">Document Information</a></li>
						</ul>
					</li>

					<!-- Referrals Link -->
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('user.walletbalance') }}">
							<i class="align-middle">₹</i> <span class="align-middle">Referrals</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link d-none d-sm-inline-block" href="/logout">
								<i class="align-middle" data-feather="log-out"></i> <span class="align-middle" style="font-size: 14px">Logout</span>
                            </a>
						</li>
					</ul>
				</div>
			</nav>

            <main class="content">
				<div class="container-fluid p-0">
					<h2 class="mb-3 text-center">My Loans</h2>
					<div class="row">
						<div class="col-md-10 mx-auto d-flex">
							<div class="w-100">
                                @if ($loans->isNotEmpty())
                                    <div class="accordion" id="loanAccordion">
                                        @foreach ($loans as $loan)
                                            <div class="accordion-item">
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
			</main>
			<footer class="sticky-footer bg-white py-3">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <samll><span class="text-body"><a href="#" class="border-bottom text-primary">2024 <i class="far fa-copyright text-dark me-1"></i> Jfinserv Consultant</a>, All rights reserved | Developed By <a class="border-bottom text-primary" href="https://jfstechnologies.com">JFS Technologies</a>.</span></samll>
                    </div>
                </div>
            </footer>
		</div>
	</div>

	<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
	

</body>
</html>