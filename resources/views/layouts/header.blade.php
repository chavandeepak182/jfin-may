<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('theme/dist-assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- SB Admin CSS -->
    <link href="{{ asset('theme/dist-assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('theme/dist-assets/css/sb-admin-3.css') }}" rel="stylesheet">

    <!-- Summernote -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('style')

    <!-- ================= SCROLL FIX (IMPORTANT) ================= -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        #wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            overflow: hidden;
        }

        /* ✅ MAIN SCROLL AREA */
        #content-wrapper {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: #f8f9fc;
        }

        #content {
            padding: 20px;
            min-height: 100%;
        }

        /* Fix when sidebar toggled */
        body.sidebar-toggled #content-wrapper {
            overflow-y: auto !important;
        }

        /* Sidebar Color */
        .bg-gradient-primary {
            background-color: #293c74 !important;
        }

        .sidebar-dark .nav-item .nav-link i {
            color: #fff;
        }
    </style>
</head>

<body id="page-top">

<div id="wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- CONTENT WRAPPER --}}
    <div id="content-wrapper" class="d-flex flex-column">

        {{-- MAIN CONTENT --}}
        <div id="content">

            {{-- TOPBAR --}}
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <h4 class="ml-3 font-weight-bold text-primary">
                    WELCOME TO JFINSERV
                </h4>

                <ul class="navbar-nav ml-auto">

                    {{-- Notifications --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger badge-counter">
                                {{ \App\Models\NotificationLog::where('user_id', auth()->id())->where('seen_by_user', false)->count() }}
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                            <h6 class="dropdown-header">Notifications</h6>

                            @forelse(\App\Models\NotificationLog::where('user_id', auth()->id())->latest()->limit(5)->get() as $n)
                                <a class="dropdown-item d-flex align-items-center" href="{{ $n->url ?? '#' }}">
                                    <div class="mr-3">
                                        <i class="fas fa-bell text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $n->created_at->diffForHumans() }}</div>
                                        <span>{{ $n->title }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center text-muted">
                                    No notifications
                                </div>
                            @endforelse
                        </div>
                    </li>

                    {{-- USER --}}
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                {{ Session::get('username') }}
                            </span>
                            <img class="img-profile rounded-circle"
                                 src="{{ asset('theme/dist-assets/img/undraw_profile.svg') }}">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>

            {{-- PAGE CONTENT --}}
            @yield('content')

        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('theme/dist-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/dist-assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('theme/dist-assets/js/sb-admin-2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@yield('script')
@stack('scripts')

</body>
</html>
