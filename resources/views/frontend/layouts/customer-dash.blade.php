<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('theme') }}/user-dash/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <!-- <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <title>@yield('title')</title>
    <style>
/* =========================================
   FINMATE STYLE SIDEBAR (JFINSERV)
========================================= */

/* Sidebar container */
.sidebar,
.sidebar-content {
    background: #ffffff !important;
    border-right: 1px solid #e5e7eb;
}

/* Logo area */
.sidebar-brand {
    background: #ffffff !important;
    padding: 20px;
    border-bottom: 1px solid #f1f5f9;
}

/* Remove any default dark bg */
.sidebar-item {
    background: transparent !important;
}

/* Sidebar links – default */
.sidebar-link {
    background: transparent !important;
    color: #475569 !important; /* slate-600 */
    padding: 14px 18px;
    margin: 6px 12px;
    border-radius: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all 0.2s ease;
}

/* Icons default */
.sidebar-link i,
.sidebar-link svg {
    font-size: 18px;
    color: #94a3b8 !important; /* slate-400 */
}

/* Hover */
.sidebar-link:hover {
    background: #f1f5f9 !important;
    color: #1e293b !important;
}

/* Hover icon */
.sidebar-link:hover i {
    color: #1e293b !important;
}

/* ACTIVE ITEM (Finmate style) */
.sidebar-item.active > .sidebar-link {
    background: #3b82f6 !important; /* Blue-500 */
    color: #ffffff !important;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.35);
}

/* Active icon */
.sidebar-item.active > .sidebar-link i {
    color: #ffffff !important;
}

/* Badge (notification count like FINMATE) */
.sidebar-link .badge {
    background: #eef2ff;
    color: #3b82f6;
    font-size: 11px;
    font-weight: 600;
    border-radius: 999px;
    padding: 4px 8px;
    margin-left: auto;
}

/* Dropdown arrow */
.sidebar-link .fa-angle-down {
    margin-left: auto;
    color: #94a3b8;
}

/* Submenu */
.collapse .sidebar-link {
    background: transparent !important;
    padding-left: 48px;
    font-size: 14px;
    color: #64748b !important;
}

/* Submenu hover */
.collapse .sidebar-link:hover {
    background: #eef2ff !important;
}

/* Remove disabled / faded look */
.sidebar-link[aria-disabled],
.sidebar-link.disabled {
    opacity: 1 !important;
}


    </style>

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ url('/') }}">
                    <span class="align-middle"><img width="100%" height="50px" src="{{ asset('theme/logo.png') }}"></span>
                </a>

                <ul class="sidebar-nav">

                    <!-- Dashboard -->
                    <li class="sidebar-item {{ Request::is('my-profile') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('/my-profile') }}">
                            <i class="fas fa-tachometer-alt custom-icon"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <!-- My Queries -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('tickets.index') }}">
                            <i class="fas fa-question-circle"></i>
                            <span class="align-middle">My Queries</span>
                        </a>
                    </li>

                    <!-- My Calls -->
                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="fas fa-phone"></i>
                            <span class="align-middle">My Calls</span>
                        </a>
                    </li> -->

                    <!-- My Loans Dropdown -->
                    <li class="sidebar-item {{ Request::is('myloans*') || Request::is('loans-list') ? 'active' : '' }}">
                        <a class="sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#loan-dropdown" aria-expanded="false">
                            <i class="fas fa-credit-card"></i>
                            <span class="align-middle">
                                My Loans <i class="fas fa-angle-down ms-1"></i>
                            </span>
                        </a>
                        <ul class="collapse {{ Request::is('myloans*') || Request::is('loans-list') ? 'show' : '' }}" id="loan-dropdown">
                            <li>
                                <a class="sidebar-link" href="{{ route('loans.loans-list') }}">
                                    Loan
                                </a>
                            </li>
                            <li>
                                <a class="sidebar-link" href="{{ route('loan.myloans') }}">
                                    Track Loan
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Documents -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('loan.mydocuments')}}">
                            <i class="fas fa-file-alt"></i>
                            <span class="align-middle">Documents</span>
                        </a>
                    </li>

                    <!-- Properties -->
                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="fas fa-building"></i>
                            <span class="align-middle">Properties</span>
                        </a>
                    </li> -->

                    <!-- Refer & Earn -->
                    <li class="sidebar-item {{ Request::is('user/walletbalance*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('user.walletbalance') }}">
                            <i class="fas fa-gift"></i>
                            <span class="align-middle">Refer & Earn</span>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="sidebar-item {{ Request::is('mypersonal*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('loan.mypersonal') }}">
                            <i class="fas fa-cog"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('help-support*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('user.help.support') }}">
                            <i class="fas fa-question-circle"></i>
                            <span class="align-middle">Help & Support</span>
                        </a>
                    </li>

                </ul>

            </div>
        </nav>

        <div class="main">
           <nav class="navbar navbar-expand navbar-light navbar-bg border-bottom">
            <a class="sidebar-toggle js-sidebar-toggle me-3">
                <i class="hamburger align-self-center"></i>
            </a>

            {{-- Search --}}
            <form class="d-none d-md-inline-block">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-0">
                        <i data-feather="search"></i>
                    </span>
                    <input type="text"
                        class="form-control border-0 bg-light"
                        placeholder="Search...">
                </div>
            </form>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto align-items-center">

                    {{-- Messages --}}
                    <!-- <li class="nav-item me-2">
                        <a class="nav-icon" href="{{ route('messages.index') }}">
                            <div class="position-relative">
                                <i data-feather="mail"></i>
                                <span class="indicator" id="mailbox-count">0</span>
                            </div>
                        </a>
                    </li> -->

                    {{-- Notifications --}}
                    <li class="nav-item dropdown me-2">
                        <a class="nav-icon dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <i data-feather="bell"></i>
                                <span class="indicator">
                                    {{ \App\Models\NotificationLog::where('user_id', auth()->id())->where('seen_by_user', false)->count() }}
                                </span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0">
                            <div class="dropdown-menu-header">
                                Notifications
                            </div>

                            <div class="list-group">
                                @forelse(
                                    \App\Models\NotificationLog::where('user_id', auth()->id())
                                    ->orderBy('created_at','desc')
                                    ->limit(5)->get()
                                    as $notification
                                )
                                    <a href="{{ $notification->url ?? '#' }}"
                                    class="list-group-item list-group-item-action {{ $notification->seen_by_user ? '' : 'fw-bold' }}">
                                        <div class="d-flex">
                                            <i class="me-2 text-primary" data-feather="{{ $notification->icon ?? 'bell' }}"></i>
                                            <div>
                                                <div>{{ $notification->title }}</div>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center text-muted py-3">No notifications</div>
                                @endforelse
                            </div>

                            <div class="dropdown-menu-footer text-center">
                                <a href="{{ route('notifications.index') }}">View all</a>
                            </div>
                        </div>
                    </li>

                    {{-- Avatar Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        data-bs-toggle="dropdown">
                            <img
                                src="https://api.dicebear.com/7.x/avataaars/svg?seed=John"
                                class="rounded-circle"
                                width="36"
                                height="36"
                                alt="Avatar">
                            <div class="d-none d-sm-block ms-2 text-start">
                                <div class="fw-bold">{{ auth()->user()->name ?? 'User' }}</div>
                                <small class="text-muted">
                                    
                                    {{ auth()->user()->last_login_at
                                        ? auth()->user()->last_login_at->format('d M , h:i A')
                                        : '—'
                                    }}
                                </small>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" class="me-2"></i> Logout
                            </a>

                            <form id="logout-form"
                                action="{{ route('logout') }}"
                                method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
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
                        <samll><span class="text-body"><a href="#" class="border-bottom text-primary">2024 <i
                                        class="far fa-copyright text-dark me-1"></i> Jfinserv Consultant</a>, All
                                rights reserved | Developed By <a class="border-bottom text-primary"
                                    href="https://jfstechnologies.com">JFS Technologies</a>.</span></samll>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @yield('Pop-up Moda')

    <script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
    {{-- <script>
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
	</script> --}}

    @yield('custom-script')
    <script>
        $(document).ready(function() {
            // Mark notification as read when clicked
            $(document).on('click', '#notification-list a.list-group-item', function(e) {
                e.preventDefault();
                var notificationId = $(this).data('id');
                var url = $(this).attr('href');

                // Mark as read via AJAX
                $.ajax({
                    url: '/notifications/mark-as-read/' + notificationId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        if (url !== '#') {
                            window.location.href = url;
                        } else {
                            $(this).removeClass('unread-notification');
                            updateNotificationCount();
                        }
                    }.bind(this)
                });
            });

            // Mark all notifications as read
            $('#mark-all-notifications-read').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/notifications/mark-all-read',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('.unread-notification').removeClass('unread-notification');
                        updateNotificationCount();
                        $('#notification-header').text('No new notifications');
                    }
                });
            });

            // Function to update notification count
            function updateNotificationCount() {
                $.get('/notifications/unread-count', function(data) {
                    $('#notification-count').text(data.count);
                    if (data.count > 0) {
                        $('#notification-header').text('You have ' + data.count + ' new notifications');
                    } else {
                        $('#notification-header').text('No new notifications');
                    }
                });
            }

            // Optional: Poll for new notifications every 30 seconds
            setInterval(updateNotificationCount, 30000);
        });
    </script>
</body>

</html>
