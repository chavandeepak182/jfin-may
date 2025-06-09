<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('theme') }}/dist-assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('theme') }}/frontend//img/favicon.png">


    @yield('style')

    <style>
        /* Notification Indicator */
        .indicator {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #e74a3b;
            color: white;
            font-size: 9px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Notification Dropdown */
        .dropdown-menu-lg {
            min-width: 380px;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.35rem;
            overflow: hidden;
            padding: 0;
            margin-top: 0.5rem;
        }

        /* Notification Header */
        .dropdown-menu-header {
            padding: 0.75rem 1.5rem;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
            color: #4e73df;
            background-color: #f8f9fc;
        }

        /* Notification List */
        .notification-list {
            max-height: 350px;
            overflow-y: auto;
        }

        /* Notification Items */
        .notification-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e3e6f0;
            transition: background-color 0.2s;
            display: flex;
            align-items: flex-start;
        }

        .notification-item:hover {
            background-color: #f8f9fc;
            text-decoration: none;
        }

        .unread-notification {
            background-color: rgba(78, 115, 223, 0.05);
            border-left: 3px solid #4e73df;
        }

        /* Notification Icon */
        .notification-icon {
            margin-right: 1rem;
            color: #4e73df;
            font-size: 1.25rem;
            margin-top: 0.25rem;
        }

        /* Notification Content */
        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 0.25rem;
        }

        .notification-desc {
            color: #858796;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .notification-time {
            color: #b7b9cc;
            font-size: 0.75rem;
        }

        /* Notification Footer */
        .dropdown-menu-footer {
            padding: 0.75rem 1.5rem;
            border-top: 1px solid #e3e6f0;
            background-color: #f8f9fc;
            display: flex;
            justify-content: space-between;
        }

        .dropdown-menu-footer a {
            color: #4e73df;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .dropdown-menu-footer a:hover {
            text-decoration: underline;
            color: #224abe;
        }

        /* Empty State */
        .empty-notifications {
            padding: 2rem;
            text-align: center;
            color: #858796;
        }

        .empty-notifications i {
            font-size: 2rem;
            color: #dddfeb;
            margin-bottom: 0.5rem;
        }

        /* Bell Icon */
        .nav-icon.dropdown-toggle {
            color: #d1d3e2;
            padding: 0.5rem;
            position: relative;
        }

        .nav-icon.dropdown-toggle:hover {
            color: #b7b9cc;
        }

        .position-relative {
            position: relative;
        }

        .topbar .nav-item.dropdown .dropdown-toggle::after {
            display: none !important;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <img width="100%" height="50px" src="{{ asset('theme/frontend/img/logo-white.svg') }}">
                </div>
                <!-- <div class="sidebar-brand-text mx-3">{{ Session::get('username') }}</div> -->
            </a>

            <?php
            $role_id = session()->get('role_id');
            if ($role_id == 4) {
            ?>
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt custom-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php 
            } elseif ($role_id == 2) { 
            ?>
            <li
                class="nav-item {{ Request::segment(1) == 'agent' && Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('agentDashboard') }}">
                    <i class="fas fa-tachometer-alt custom-icon"></i>
                    <span>Agent Dashboard</span>
                </a>
            </li>
            <?php 
            
            } elseif ($role_id == env('partnerRole_id')) { 
            ?>
            <li
                class="nav-item {{ Request::segment(1) == 'agent' && Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partnerDashboard') }}">
                    <i class="fas fa-tachometer-alt custom-icon"></i>
                    <span>CP Dashboard</span>
                </a>
            </li>
            <?php 
            }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php
                 $role_id = session()->get('role_id');
                 if($role_id == env('brokerRole_id')) {
            ?>
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('allLoansApplications') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Loan Applications</span></a>
            </li>

            <?php } ?>


            <?php
                 $role_id = session()->get('role_id');
                 if($role_id == 4) {
            ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users custom-icon"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users Components:</h6>
                        <a class="collapse-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'allUsers' ? 'active' : '' }}"
                            href="{{ route('allUsers') }}">All Users</a>
                        <a class="collapse-item {{ Request::segment(1) == 'agent' && Request::segment(2) == 'allAgents' ? 'active' : '' }}"
                            href="{{ route('allAgents') }}">Employee/Officer</a>
                        <a class="collapse-item {{ Request::segment(1) == 'partner' && Request::segment(2) == 'allPartners' ? 'active' : '' }}"
                            href="{{ route('allPartners') }}">Channel Partner</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans"
                    aria-expanded="true" aria-controls="collapseLoans">
                    <i class="fas fa-fw fa-folder custom-icon"></i>
                    <span>Loans</span>
                </a>
                <div id="collapseLoans" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Loans Components:</h6>
                        <a class="collapse-item" href="{{ route('loans.index') }}">All</a>
                        <a class="collapse-item" href="{{ route('pendingLoans') }}">Pending Assign</a>
                        <a class="collapse-item" href="{{ route('inprocess.loans') }}">In Process Loans</a>
                        {{-- <a class="collapse-item" href="{{ route('approvedLoans')}}">Approved Loans</a>
                        <a class="collapse-item" href="{{ route('disbursed.loans')}}">Disbursed Loans</a>
                        <a class="collapse-item" href="{{ route('rejectedLoans')}}">Rejected Loans</a> --}}
                    </div>
                </div>
            </li>
            <?php } ?>

            <!--Agent navigation -->
            <?php    if($role_id == 2) { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans"
                    aria-expanded="true" aria-controls="collapseLoans">
                    <i class="fas fa-fw fa-folder custom-icon"></i>
                    <span>Loans</span>
                </a>
                <div id="collapseLoans" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Loans Components:</h6>
                        <a class="collapse-item" href="{{ route('agent.allAgentLoans') }}">All </a>
                        <a class="collapse-item" href="{{ route('agent.assignedLoans') }}">Assign </a>
                        {{-- <a class="collapse-item" href="{{ route('agent.inprocess.loans') }}">In Process</a>
                            <a class="collapse-item" href="{{ route('agent.documentpending.loans') }}">Document Pending</a>                        
                            <a class="collapse-item" href="{{ route('agent.approved.loans')}}">Approved</a>
                            <a class="collapse-item" href="{{ route('agent.rejected.loans')}}">Rejected</a> --}}
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php    if($role_id == 4) { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperty"
                    aria-expanded="true" aria-controls="collapseLeads">
                    <i class="fas fa-fw fa-home custom-icon"></i>
                    <span>Property</span>
                </a>
                <div id="collapseProperty" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Property:</h6>
                        <a class="collapse-item" href="{{ route('pendingProperties') }}">Pending Property</a>
                        <a class="collapse-item" href="{{ route('allProperties') }}">List Property</a>
                        <a class="collapse-item" href="{{ route('addProperty') }}">Add Property</a>
                        <a class="collapse-item" href="{{ route('property_takers.index') }}">Property Taker</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <?php    if($role_id == env('partnerRole_id')) { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperty"
                    aria-expanded="true" aria-controls="collapseLeads">
                    <i class="fas fa-fw fa-home custom-icon"></i>
                    <span>Property</span>
                </a>
                <div id="collapseProperty" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Property:</h6>
                        <a class="collapse-item" href="{{ route('allProperties') }}">List Property</a>
                        <a class="collapse-item" href="{{ route('addProperty') }}">Add Property</a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php    if($role_id == 4) { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeads"
                    aria-expanded="true" aria-controls="collapseLeads">
                    <i class="fas fa-fw fa-tasks custom-icon"></i>
                    <span>Web Form & Leads</span>
                </a>
                <div id="collapseLeads" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Web Form & Leads:</h6>
                        <a class="collapse-item" href="{{ route('enquiries.enquiryLead') }}">Enquiry Leads</a>
                        <a class="collapse-item" href="#">Property Leads</a>
                        <a class="collapse-item" href="/admin/leads">Leads</a>
                    </div>
                </div>
            </li>

            <?php } ?>


            <!-- Nav Item - Pages Collapse Menu -->
            <?php    if($role_id == 4) { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-rupee-sign custom-icon"></i>
                    <span>Referral</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Referral Management:</h6>
                        <a class="collapse-item" href="{{ route('admin.withdrawal.requests') }}">Reddem Requests</a>
                        <a class="collapse-item" href="{{ route('referral_earnings') }}">Referral Earnings</a>
                        <a class="collapse-item" href="{{ route('admin.transactions') }}">Transaction History</a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <!-- <?php    if($role_id == 2) { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-fw fa-dollar-sign fa-2x custom-icon"></i>
                    <span>Referral</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Referral Management:</h6>
                        <a class="collapse-item" href="{{ route('walletbalance') }}">Wallet</a>
                        <a class="collapse-item" href="{{ route('referral_earnings') }}">Referral Earnings</a>
                    </div>
                </div>
            </li>
            <?php } ?> -->

            <?php    if($role_id == 2) { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferral"
                    aria-expanded="true" aria-controls="collapseReferral">
                    <i class="fas fa-fw fa-tasks custom-icon"></i>
                    <span>Leads</span>
                </a>
                <div id="collapseReferral" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lead Management:</h6>
                        <a class="collapse-item" href="#">Add Lead</a>
                        <a class="collapse-item" href="#">All Leads</a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php    if($role_id == 4) { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools"
                    aria-expanded="true" aria-controls="collapseTools">
                    <i class="fas fa-fw fa-wrench custom-icon"></i>
                    <span>Tools</span>
                </a>
                <div id="collapseTools" class="collapse" aria-labelledby="headingLoan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tools:</h6>
                        <a class="collapse-item" href="{{ route('allbanks') }}">Tied Up Banks</a>
                        <a class="collapse-item" href="{{ route('loanbanks') }}">Loan Banks</a>
                        <!-- <a class="collapse-item" href="{{ route('sanctioncalculator') }}">Eligiblity Calculation</a> -->
                        <a class="collapse-item" href="{{ route('mis.index') }}">MIS</a>
                        <!-- <a class="collapse-item" href="buttons.html">Invoice</a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Activity logs -->
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'activities' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('activities') }}">
                    <i class="fas fa-history custom-icon"></i>
                    <span>Activity Logs</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Activity logs -->
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'tree' ? 'active' : '' }}">
                <!-- <a class="nav-link" href="{{ route('mlmView') }}"> -->
                <a class="nav-link" href="{{ route('admin.tree.show') }}">
                    <i class="fas fa-project-diagram custom-icon"></i>
                    <span>MLM</span></a>
            </li>

            <!-- Nav Item - Commission -->
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'allCommission' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('allCommission') }}">
                    <i class="fas fa-percentage custom-icon"></i>
                    <span>Commission</span></a>
            </li>

            <!-- Nav Item - Elgiblity criteria -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseEligibility" aria-expanded="true" aria-controls="collapseEligibility">
                    <i class="fas fa-clipboard-list custom-icon"></i>
                    <span>Eligibility Calculation</span>
                </a>
                <div id="collapseEligibility" class="collapse" aria-labelledby="headingEligibility"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Eligibility:</h6>
                        <a class="collapse-item" href="{{ route('eligibilityCriteria') }}">Eligibility Criteria</a>
                        <a class="collapse-item" href="{{ route('standalone.self') }}">Self(for admin)</a>
                        <a class="collapse-item" href="#">Salaried(for admin)</a>
                    </div>
                </div>
            </li>

            <?php } ?>
            <?php    if($role_id == 2) { ?>
            <hr class="sidebar-divider">

            <!-- Nav Item - Agent MIS -->
            <li
                class="nav-item {{ Request::segment(1) == 'admin' && Request::segment(2) == 'activity' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('agent.mis') }}">

                    <i class="fa fa-address-book"></i>
                    <span>MIS</span></a>
            </li>
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top">
                    <!-- <h2><b>Dashboard</b></h2> -->

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <!-- Mail Icon (Clickable link) -->
                            <a class="nav-link" href="{{ route('messages.index') }}" id="mailDropdown"
                                role="button">
                                <i class="fas fa-envelope fa-fw mr-2 text-gray-600"></i>
                                {{-- <span class="indicator" id="mail-notification-count"></span> --}}
                            </a>
                        </li>
                        <!-- Notification Icon -->
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-toggle="dropdown" aria-expanded="false">
                                <div class="position-relative">
                                    <i class="fas fa-bell fa-fw text-gray-600"></i>
                                    <span class="indicator"
                                        id="notification-count">{{ \App\Models\NotificationLog::where('user_id', auth()->id())->where('seen_by_user', false)->count() }}</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0 shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    @php
                                        $unreadCount = \App\Models\NotificationLog::where('user_id', auth()->id())
                                            ->where('seen_by_user', false)
                                            ->count();
                                    @endphp
                                    @if ($unreadCount > 0)
                                        <span id="notification-header">You have {{ $unreadCount }} new
                                            notifications</span>
                                    @else
                                        <span id="notification-header">No new notifications</span>
                                    @endif
                                </div>
                                <div class="notification-list" id="notification-list">
                                    @forelse(\App\Models\NotificationLog::where('user_id', auth()->id())
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get() as $notification)
                                        <a href="{{ $notification->url ?? '#' }}"
                                            class="notification-item {{ $notification->seen_by_user ? '' : 'unread-notification' }}"
                                            data-id="{{ $notification->id }}">
                                            <div class="notification-icon">
                                                <i class="fas fa-{{ $notification->icon ?? 'bell' }}"></i>
                                            </div>
                                            <div class="notification-content">
                                                <div class="notification-title">{{ $notification->title }}</div>
                                                <div class="notification-desc">{{ $notification->description }}</div>
                                                <div class="notification-time">
                                                    {{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="empty-notifications">
                                            <i class="fas fa-bell-slash"></i>
                                            <div>No notifications found</div>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="{{ route('notifications.index') }}">View all notifications</a>
                                    @if ($unreadCount > 0)
                                        <a href="#" id="mark-all-notifications-read">Mark all as read</a>
                                    @endif
                                </div>
                            </div>
                        </li>

                        <?php    if($role_id == 4) { ?>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get('username') }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('theme') }}/dist-assets/img/undraw_profile_2.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                        <?php    if($role_id == env('partnerRole_id')) { ?>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get('username') }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('theme') }}/dist-assets/img/undraw_profile_2.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('partner.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                        <?php    if($role_id == 2) { ?>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get('username') }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('theme') }}/dist-assets/img/undraw_profile_2.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                {{-- main content --}}
                <div class="main-content">
                    @yield('content')

                </div>
                {{-- end main content --}}

            </div>
            <!-- End of Content Wrapper -->
            @include('layouts.footer')
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('theme') }}/dist-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('theme') }}/dist-assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('theme') }}/dist-assets/js/sb-admin-2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
        <script>
            $("document").ready(function() {

                var zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                console.log(zone);
                // $("#currentTimezone").val(zone);
            });
        </script>

        <script>
            $(document).ready(function() {
                // Mark notification as read when clicked
                $(document).on('click', '#notification-list a.notification-item', function(e) {
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

        @yield('script')
</body>
