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
							<li class="sidebar-item active"><a class="sidebar-link" href="{{ route('loan.mypersonal') }}">Personal Information</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.myprofessional') }}">Professional Information</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.myeducation') }}">Educational Information</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('loan.mydocuments') }}">Document Information</a></li>
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
					<h2 class="mb-3 text-center">Personal Information</h2>
					<div class="row">
						<div class="col-md-10 mx-auto d-flex">
							<div class="w-100">
                                @if ($profile)
                                    <div class="bg-white py-5 px-5 rounded">
                                        <h4 class="m-0 text-primary"><strong>{{ $user->name }}</strong></h4>
                                        <p>{{ $user->email_id }}</p>
                                        <p class="m-0">Mobile No.: <strong>{{ $profile->mobile_no }}</strong></p>
                                        <p>Gender: <strong>{{ $profile->gender }}</strong> <span class="px-2">|</span> DOB: <strong>{{ $profile->dob }}</strong> <span class="px-2">|</span> Marital Status: <strong>{{ $profile->marital_status }}</strong></p>
                                        <p class="m-0">Residence: <strong>{{ $profile->residence_address }}</strong></p>
                                        <p>City: <strong>{{ $profile->city }}</strong> <span class="px-2">|</span> State: <strong>{{ $profile->state }}</strong> <span class="px-2">|</span> Pincode: <strong>{{ $profile->pincode }}</strong></p>
                                        <p class="mt-5"><a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="far fa-edit me-2"></i> Update</a></p>
                                    </div>
                                @else
                                    <p>No personal information available.</p>
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



        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email ID -->
                            <div class="mb-3">
                                <label for="email_id" class="form-label">Email ID</label>
                                <input type="email" class="form-control @error('email_id') is-invalid @enderror" id="email_id" name="email_id" value="{{ old('email_id', $user->email_id) }}">
                                @error('email_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile No -->
                            <div class="mb-3">
                                <label for="mobile_no" class="form-label">Mobile No</label>
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $profile->mobile_no) }}">
                                @error('mobile_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $profile->dob) }}">
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="marital_status" class="form-label">Marital Status</label>
                                <input type="text" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status" name="marital_status" value="{{ old('marital_status', $profile->marital_status) }}">
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="residence_address" class="form-label">Residence Address</label>
                                <input type="text" class="form-control @error('residence_address') is-invalid @enderror" id="residence_address" name="residence_address" value="{{ old('residence_address', $profile->residence_address) }}">
                                @error('residence_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $profile->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $profile->state) }}">
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ old('pincode', $profile->pincode) }}">
                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

	<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>

</body>
</html>