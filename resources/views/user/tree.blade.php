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
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">My Loans  <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="loan-dropdown">
							<li><a class="sidebar-link" href="{{ route('loan.myloans') }}">Track Loan</a></li>
							<li><a class="sidebar-link" href="#">Total Loans</a></li>
						</ul>
					</li>

					<li class="sidebar-item active">
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
                    <h2 class="mb-3 text-center">Child Nodes and Their Loans</h2>

                    @if($descendants->isEmpty())
                        <p class="text-center">No child nodes found for this user.</p>
                    @else
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Referral Code</th>
                                    <th>Parent Name</th>
                                    <th>Loans</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($descendants as $index => $descendant)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $descendant->name }}</td>
                                        <td>{{ $descendant->referral_code }}</td>
                                        <td>{{ $descendant->parent_name }}</td>
                                        <td>
                                            <select class="form-select child-loans-dropdown" data-user-id="{{ $descendant->user_id }}">
                                                <option value="" selected disabled>Select to view loans</option>
                                                <option value="view">View Loans</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="loan-details" class="mt-4" style="display:none;">
                            <h3>Loans for Selected User</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Loan Reference ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
            <footer class="sticky-footer bg-white py-3">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <samll><span class="text-body"><a href="#" class="border-bottom text-primary">2024 <i class="far fa-copyright text-dark me-1"></i> Jfinserv Consultant</a>, All rights reserved | Developed By <a class="border-bottom text-primary" href="https://jfstechnologies.com">JFS Technologies</a>.</span></samll>
                                </div>
                            </div>
                        </footer>
                        <script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
                        <script>
                document.querySelectorAll('.child-loans-dropdown').forEach(dropdown => {
                dropdown.addEventListener('change', function() {
                    const userId = this.getAttribute('data-user-id');
                    
                    fetch(`/loans-by-child?user_id=${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            const loanDetailsDiv = document.getElementById('loan-details');
                            const tableBody = loanDetailsDiv.querySelector('tbody');
                            tableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach((loan, index) => {
                                    const row = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${loan.loan_reference_id}</td>  <!-- Display the loan_reference_id -->
                                        <td>${loan.amount}</td>
                                        <td>${loan.status}</td>
                                        <td>${loan.category_name}</td>
                                        <td>${loan.created_at}</td>
                                    </tr>`;
                                    tableBody.insertAdjacentHTML('beforeend', row);
                                });
                            } else {
                                tableBody.innerHTML = '<tr><td colspan="6">No loans found for this user.</td></tr>';
                            }

                            loanDetailsDiv.style.display = 'block';
                        });
                });
            });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const loanDetailsSection = document.getElementById('loan-details');
    const loanDetailsBody = loanDetailsSection.querySelector('tbody');

    document.querySelectorAll('.child-loans-dropdown').forEach(dropdown => {
        dropdown.addEventListener('change', async (event) => {
            const userId = event.target.getAttribute('data-user-id');
            const action = event.target.value;

            if (action === 'view') {
                loanDetailsBody.innerHTML = '<tr><td colspan="6" class="text-center">Loading...</td></tr>';
                dropdown.disabled = true;

                try {
                    const response = await fetch(`/api/loans/${userId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const loans = await response.json();
                    loanDetailsBody.innerHTML = '';

                    if (loans.length > 0) {
                        loans.forEach((loan, index) => {
                            loanDetailsBody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${loan.loan_reference_id}</td>
                                    <td>${loan.amount}</td>
                                    <td>${loan.status}</td>
                                    <td>${loan.category}</td>
                                    <td>${loan.created_at}</td>
                                </tr>`;
                        });
                    } else {
                        loanDetailsBody.innerHTML = '<tr><td colspan="6" class="text-center">No loans found for this user.</td></tr>';
                    }

                    loanDetailsSection.style.display = 'block';
                } catch (error) {
                    console.error('Error fetching loans:', error);
                   
                } finally {
                    dropdown.disabled = false;
                }
            }
        });
    });
});
</script>
</body>
</html>
