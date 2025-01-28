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
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
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
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.myloans') }}">Track Loan</a></li>
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
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.mypersonal') }}">Personal Information</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.myprofessional') }}">Professional Information</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.myeducation') }}">Educational Information</a></li>
							<li class="sidebar-item active"><a class="sidebar-link" href="{{ route('loan.mydocuments') }}">Document Information</a></li>
						</ul>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#referral-dropdown" aria-expanded="false">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Referral <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="referral-dropdown" >
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('user.walletbalance') }}">Wallet</a></li>
							<li><a class="sidebar-link" href="{{ route('transactions.list') }}">Transactions</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <!-- Navbar content here (unchanged) -->
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <h2 class="mb-3 text-center">My Loan List</h2>
                    <!-- Filter Form -->
                    <div class="row">
                        <div class="col-md-4 mx-auto mb-3">
                            <form method="GET" action="{{ route('loans.loans-list') }}">
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Filter by Status --</option>
                                    <option value="approved" {{ request()->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request()->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="disbursed" {{ request()->status == 'disbursed' ? 'selected' : '' }}>Disbursed</option>
                                    <option value="in process" {{ request()->status == 'in process' ? 'selected' : '' }}>In Process</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            @if ($loans && count($loans) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Loan Reference ID</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loans as $index => $loan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $loan->loan_reference_id }}</td>
                                                <td>{{ number_format($loan->amount, 2) }}</td>
                                                <td>{{ ucfirst($loan->status) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($loan->created_at)->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No loans found.</p>
                            @endif
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
