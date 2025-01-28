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
    <title>Professional</title>
   
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
							<li class="sidebar-item active"><a class="sidebar-link" href="{{ route('loan.myprofessional') }}">Professional Information</a></li>
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
					<h2 class="mb-3 text-center">Professional Information</h2>
					<div class="row">
						<div class="col-md-10 mx-auto d-flex">
							<div class="w-100">
								@if ($professionalDetails)
									<div class="bg-white py-5 px-5 rounded">
										<p>Designation: <strong>{{ $professionalDetails->designation }}</strong></p>
										<p>Company Name: <strong>{{ $professionalDetails->company_name }}</strong></p>
										<p>Years of Experience: <strong>{{ $professionalDetails->experience_year }} yrs</strong></p>
										<p>Company Address: <strong>{{ $professionalDetails->company_address }}</strong></p>
										<p>Industry: <strong>{{ $professionalDetails->industry }}</strong></p>
										<p class="mt-5">
											<a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfessionalModal">
												<i class="far fa-edit me-2"></i> Update
											</a>
										</p>
									</div>
								@else
									<p>No professional information available. Please add your details.</p>
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

            <!-- Edit Professional Modal -->
            <div class="modal fade" id="editProfessionalModal" tabindex="-1" aria-labelledby="editProfessionalModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfessionalModalLabel">Edit Professional Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.professional.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="professional_id" value="{{ $professionalDetails->professional_id ?? '' }}">

                                <!-- Profession Type -->
                                <div class="mb-3">
									<label for="profession_type" class="form-label">Profession Type</label>
									<input type="text" class="form-control @error('profession_type') is-invalid @enderror" id="profession_type" name="profession_type" value="{{ old('profession_type', $professionalDetails->profession_type ?? '') }}">
									@error('profession_type')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

                                <!-- Company Name -->
                                <div class="mb-3">
									<label for="company_name" class="form-label">Company Name</label>
									<input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $professionalDetails->company_name ?? '') }}">
									@error('company_name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

                                <!-- Years of Experience -->
                                <div class="mb-3">
									<label for="experience_year" class="form-label">Years of Experience</label>
									<input type="number" class="form-control @error('experience_year') is-invalid @enderror" id="experience_year" name="experience_year" value="{{ old('experience_year', $professionalDetails->experience_year ?? '') }}">
									@error('experience_year')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

                                <!-- Company Address -->
                                <div class="mb-3">
									<label for="company_address" class="form-label">Company Address</label>
									<input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" value="{{ old('company_address', $professionalDetails->company_address ?? '') }}">
									@error('company_address')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

                                <!-- Industry -->
                                <div class="mb-3">
									<label for="industry" class="form-label">Industry</label>
									<input type="text" class="form-control @error('industry') is-invalid @enderror" id="industry" name="industry" value="{{ old('industry', $professionalDetails->industry ?? '') }}">
									@error('industry')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

                                <!-- Designation -->
                                <div class="mb-3">
									<label for="designation" class="form-label">Designation</label>
									<input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $professionalDetails->designation ?? '') }}">
									@error('designation')
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
		</div>
	</div>

	<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
</body>
</html>