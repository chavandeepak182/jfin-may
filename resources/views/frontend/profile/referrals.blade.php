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
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        
        /* Scoped CSS for Loan Tracking Section */
        /* .loan-tracking-container {
    margin-top: 50px;
    margin-bottom: 50px;
} */

/* .loan-tracking-container .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.10rem;
} */

/* .loan-tracking-container .card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
} */

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

/* .loan-tracking-container .itemside {
    display: flex;
    width: 100%;
} */

/* .loan-tracking-container .aside {
    flex-shrink: 0;
} */

/* .loan-tracking-container .img-sm {
    width: 80px;
    height: 80px;
    padding: 7px;
} */

/* .loan-tracking-container ul.row, 
.loan-tracking-container ul.row-sm {
    list-style: none;
    padding: 0;
} */

/* .loan-tracking-container .info {
    padding-left: 15px;
    padding-right: 7px;
} */

/* .loan-tracking-container .title {
    margin-bottom: 5px;
    color: #212529;
} */

/* .loan-tracking-container p {
    margin-top: 0;
    margin-bottom: 1rem;
} */

/* .loan-tracking-container .btn-warning {
    color: #ffffff;
    background-color: #ee5435;
    border-color: #ee5435;
    border-radius: 1px;
} */

/* .loan-tracking-container .btn-warning:hover {
    color: #ffffff;
    background-color: #ff2b00;
    border-color: #ff2b00;
    border-radius: 1px;
} */
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
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.mydocuments') }}">Document Information</a></li>
						</ul>
					</li>

					<!-- Referrals Link -->
					<li class="sidebar-item active">
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
					<h2 class="mb-3 text-center">My Wallet</h2>
					<div class="row">
						<div class="col-md-10 mx-auto d-flex">
							<div class="w-100">
                                <div class="bg-white py-5 px-5 rounded">
                                    <h4>Wallet Balance</h4>
                                    <p>Your current wallet balance is: <strong>₹{{ number_format($walletBalance, 2) }}</strong></p>

                                    <!-- Withdrawal Form -->
                                    <h4>Withdraw Funds</h4>
                                    <form action="{{ route('user.withdraw.request') }}" method="POST" class="w-50">
                                        @csrf
                                        <div class="form-group pb-4">
                                            <label for="amount">Amount to Withdraw</label>
                                            <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Request Withdrawal</button>
                                    </form>

                                    <!-- Display any success messages -->
                                    @if(session('message'))
                                        <div class="alert alert-success mt-3">
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <!-- Transaction History -->
                                    <h4 class="mt-4">Transaction History</h4>
                                    <div class="table-responsive">
                                        <table id="transactionHistory" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($combinedData as $data)
                                                    <tr>
                                                        <td>{{ $data->transaction_id ?? $data->id }}</td>
                                                        <td>₹{{ number_format($data->amount, 2) }}</td>
                                                        <td>
                                                            <span class="{{ $data->status == 'pending' ? 'text-warning' : ($data->status == 'completed' ? 'text-success' : '') }}">
                                                                {{ ucfirst($data->status) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y, h:i A') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <!-- DataTables and Export Buttons scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#transactionHistory').DataTable({
                processing: true,
                serverSide: false, // Since we are using static data, set to false
                paging: false, // Disable pagination as we're displaying all data
                searching: false, // Disable searching if not needed
                info: false, // Disable info display
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

	

</body>
</html>