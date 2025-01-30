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

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
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
                <div style="padding: 1%"> 
                    <h1><center>All Transactions</center></h1> 
                
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('transactions.list') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search transactions..." value="{{ request()->input('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                
                    <!-- Transactions Table -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Transactions List</h6>
                    </div>
                
                    <div class="card-body">
                        <div class="table-responsive" id="transaction_table">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th> <!-- Added Action Column for Eye Button -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction) <!-- Directly use transactions variable -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->user_name ?? 'No Name' }}</td>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <button class="btn btn-info show-history-btn" data-transaction-id="{{ $transaction->transaction_id }}">
                                                <i class="fa fa-eye"></i> View Invoice
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                
                            <!-- Laravel Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                {!! $transactions->appends(['search' => request()->input('search')])->links('pagination::bootstrap-5') !!}
                            </div>
                
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="text-align; margin-bottom: 10px;">
                                    <button id="downloadInvoice" class="btn btn-primary">
                                        <i class="fa fa-download"></i>
                                    </button>
                                </div>
                                <h5 class="modal-title" id="invoiceModalLabel">Transaction Invoice</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div id="transaction-invoice-content" style="padding: 20px;">
                                <div style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                                    <!-- Logo and Company Name -->
                                    <img src="../theme/frontend/img/logo.png" alt="Company Logo" style="width: 40%;margin-bottom: 10px;">
                                    <h3 style="margin: 0;">JFinserv Consultant</h3>
                                </div>
                
                                <div style="margin-top: 20px; border-bottom: 2px dashed #ddd; padding-bottom: 10px;">
                                    <!-- Customer Info -->
                                    <p><strong>Transaction ID:</strong> ${data.transaction_id}</p>
                                    <p><strong>Name:</strong> ${data.user_name}</p>
                                    <p><strong>Email:</strong> ${data.email_id }</p>
                                    <p><strong>Contact:</strong> ${data.contact}</p>
                                </div>
                
                                <div style="margin-top: 20px;">
                                    <!-- Transaction Details -->
                                    <h5>Transaction Details</h5>
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="padding: 5px;"><strong>Requested Amount:</strong></td>
                                            <td style="padding: 5px; text-align: right;">₹${data.amount}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px;"><strong>GST (2%):</strong></td>
                                            <td style="padding: 5px; text-align: right;">₹${data.gst}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px;"><strong>TDS (2%):</strong></td>
                                            <td style="padding: 5px; text-align: right;">₹${data.tds}</td>
                                        </tr>
                                        <tr style="border-top: 2px solid #000;">
                                            <td style="padding: 5px;"><strong>Final Amount:</strong></td>
                                            <td style="padding: 5px; text-align: right; font-weight: bold;">₹${data.final_amount}</td>
                                        </tr>
                                    </table>
                                </div>
                
                                <div style="margin-top: 20px; text-align: center; border-top: 2px solid #ddd; padding-top: 10px;">
                                    <!-- Footer -->
                                    <p>Status: <strong>${data.status}</strong></p>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Handle clicking on the 'eye' button to show the invoice
    $('.show-history-btn').on('click', function() {
        var transactionId = $(this).data('transaction-id');

        $.ajax({
            url: '/admin/transactions/' + transactionId + '/history',
            method: 'GET',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                var invoiceHtml = ` 
                    <div id="transaction-invoice-content" style="padding: 20px;">
                        <div style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                            <img src="../theme/frontend/img/logo.png" alt="Company Logo" style="width: 50%;margin-bottom: 10px;">
                        </div>
                        <div style="margin-top: 20px; border-bottom: 2px dashed #ddd; padding-bottom: 10px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;"> 
                                <p style="margin: 0;"><strong>Date:</strong> ${data.created_at}</p>
                            </div>
                            <p style="margin: 0;"><strong>Transaction ID:</strong> ${data.transaction_id}</p>
                            <p style="margin: 0;"><strong>Name:</strong> ${data.user_name}</p>
                            <p style="margin: 0;"><strong>Email:</strong> ${data.email_id }</p>
                            <p style="margin: 0;"><strong>Contact:</strong> ${data.contact}</p>
                        </div>
                        <div style="margin-top: 20px;">
                            <h5>Transaction Details</h5>
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 5px;"><strong>Requested Amount:</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.amount}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>GST (2%):</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.gst}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>TDS (2%):</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.tds}</td>
                                </tr>
                                <tr style="border-top: 2px solid #000;">
                                    <td style="padding: 5px;"><strong>Final Amount:</strong></td>
                                    <td style="padding: 5px; text-align: right; font-weight: bold;">₹${data.final_amount}</td>
                                </tr>
                            </table>
                        </div>

                        <div style="margin-top: 20px; text-align: center; border-top: 2px solid #ddd; padding-top: 10px;">
                            <p>Status: <strong>${data.status}</strong></p>
                        </div>
                    </div>
                `;

                $('#transaction-invoice-content').html(invoiceHtml);
                $('#invoiceModal').modal('show');
            }
        });
    });

    $('#downloadInvoice').on('click', function() {
        var invoiceContent = $('#transaction-invoice-content').html();
        var blob = new Blob([invoiceContent], { type: 'application/pdf' });
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'Invoice.pdf';
        link.click();
    });
});
</script>
   
</body>
</html>