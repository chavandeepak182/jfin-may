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
    <!-- <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet"> -->

	<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <title>@yield('title')</title>
   
</head>

<body>
	<div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ url('/') }}">
					<span class="align-middle"><img style="background-color: white;" width="100%" height="50px" src="{{ asset('theme/logo.png') }}"></span>
				</a>

				<ul class="sidebar-nav">
					<!-- Dashboard Link -->
					<li class="sidebar-item {{ Request::is('my-profile') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ url('/my-profile') }}">
							<i class="fas fa-tachometer-alt custom-icon"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<!-- My Loans Dropdown -->
					<li class="sidebar-item {{ Request::is('myloans*') || Request::is('loans-list') || Request::is('myloans') ? 'active' : ''}}">
						<a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#loan-dropdown" aria-expanded="false">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">My Loans <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="loan-dropdown">
							<li><a class="sidebar-link" href="{{ route('loans.loans-list') }}">Total Loans</a></li>
							<li><a class="sidebar-link" href="{{ route('loan.myloans') }}">Track Loan</a></li>
						</ul>
					</li>

					<li class="sidebar-item {{ Request::is('child-nodes*') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{ route('user.childNodes') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">LegDown</span>
                        </a>
					</li> 	

					<!-- My Details Dropdown -->
					<li class="sidebar-item {{ Request::is('mypersonal*') || Request::is('mypersonal') || Request::is('myprofessional') || Request::is('myeducation') || Request::is('mydocuments') ? 'active' : ''}}">
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

					<li class="sidebar-item {{ Request::is('user/walletbalance*') || Request::is('user/walletbalance') || Request::is('user/transactions') ? 'active' : ''}}">
						<a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#referral-dropdown" aria-expanded="false">
							<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Referral <i class="fas fa-angle-down"></i></span>
						</a>
						<ul class="collapse" id="referral-dropdown" >
							<li><a class="sidebar-link" href="{{ route('user.walletbalance') }}">Wallet</a></li>
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
						<li class="nav-item">
							<a class="nav-icon" href="{{ route('messages.index') }}">
								<div class="position-relative">
									<i class="align-middle" data-feather="mail"></i>
									<span class="indicator" id="mailbox-count">0</span>
								</div>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator" id="notification-count">0</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									<span id="notification-header">No New Notifications</span>
								</div>
								<div class="list-group" id="notification-list">
									<!-- Notifications will be dynamically inserted here -->
								</div>
								<div class="dropdown-menu-footer">
									<a href="/notifications" class="text-muted">Show all notifications</a>
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
                @yield('content')
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

	@yield('Pop-up Moda')

	<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Function to fetch notifications
			function fetchNotifications() {
				fetch('/notifications')
					.then(response => response.json())
					.then(data => {
						const notificationCount = data.notifications.length;
						const notificationCountElement = document.getElementById('notification-count');
						const notificationHeader = document.getElementById('notification-header');
						const notificationList = document.getElementById('notification-list');

						// Update notification count and header
						notificationCountElement.textContent = notificationCount;
						notificationHeader.textContent = `${notificationCount} New Notifications`;

						// Clear previous notifications
						notificationList.innerHTML = '';

						// Populate notification list
						if (notificationCount > 0) {
							data.notifications.forEach(notification => {
								const notificationItem = document.createElement('a');
								notificationItem.href = '#'; // Set link to notification details or action
								notificationItem.className = 'list-group-item list-group-item-action';
								notificationItem.innerHTML = `
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<i class="text-danger" data-feather="alert-circle"></i>
										</div>
										<div class="col-10">
											<div class="text-dark">${notification.message}</div>
											<div class="text-muted small mt-1">${notification.created_at}</div>
										</div>
									</div>
								`;
								notificationList.appendChild(notificationItem);

								// Add event listener to mark notification as read on click
								notificationItem.addEventListener('click', function(event) {
									event.preventDefault(); // Prevent default link behavior
									
									fetch(`/notifications/read/${notification.id}`, {
										method: 'POST',
										headers: {
											'Content-Type': 'application/json',
											'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
										}
									}).then(response => response.json())
									.then(data => {
										// Handle successful read status update
										if (data.status === 'success') {
											notificationItem.classList.add('read');
										}
									});
								});
							});
						} else {
							notificationList.innerHTML = '<p class="text-center">No notifications</p>';
						}
					})
					.catch(error => console.error('Failed to fetch notifications:', error));
			}

			// Fetch notifications when the page loads
			fetchNotifications();

			// Fetch notifications every 10 seconds
			setInterval(fetchNotifications, 10000); // 10000ms = 10 seconds
		});
	</script>

    @yield('custom-script')

</body>
</html>