<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('theme/dist-assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- SB Admin CSS -->
    <link href="{{ asset('theme/dist-assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- FIX: Load same Bootstrap CSS as customer -->
<link href="{{ asset('theme/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('theme/dist-assets/css/sb-admin-3.css') }}" rel="stylesheet">

    <!-- Summernote -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery (required for SB Admin 2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Bootstrap 4 JS (required for dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('style')

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
        .sidebar {
            height: 100vh;
            overflow: hidden;
        }
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
        body.sidebar-toggled #content-wrapper {
            overflow-y: auto !important;
        }
        .bg-gradient-primary {
            background-color: #293c74 !important;
        }
        .sidebar-dark .nav-item .nav-link i {
            color: #fff;
        }
        /* FIX FORM WIDTH IN ADMIN */
.content .container,
.content .container-fluid {
    max-width: 1140px;
    margin: auto;
}
/* FIX FORM INPUTS */
.form-control,
.form-select {
    height: calc(2.5rem + 2px);
    border-radius: 0.375rem;
}
.step,
.step-active {
    background: #0d6efd !important;
    color: #fff;
}
.form-group,
.form-floating {
    margin-bottom: 12px;
}
.form-select {
    margin-bottom: 10px;
}

    </style>
</head>

<body id="page-top">

<div id="wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- CONTENT WRAPPER --}}
    <div id="content-wrapper" class="d-flex flex-column">
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

                 {{-- 🔔 Notifications --}}
<li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" data-toggle="dropdown">
        <i class="fas fa-bell"></i>
        <span class="badge badge-danger" id="notification-count">
            {{ isset($notifications) ? $notifications->where('seen_by_user', 0)->count() : 0 }}
        </span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="notificationDropdown">
        <h6 class="dropdown-header">Notifications</h6>

        <div id="notification-list">
            @if(isset($notifications) && $notifications->count())
                @foreach($notifications as $n)
                    <a href="{{ $n->url ?? '#' }}"
                       class="dropdown-item {{ $n->seen_by_user ? '' : 'font-weight-bold' }}">
                        {{ $n->title }}
                    </a>
                @endforeach
            @else
                <div class="dropdown-item text-muted text-center">
                    No notifications
                </div>
            @endif
        </div>
    </div>

</li>



                  {{-- 👤 USER --}}
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

      <!-- ✅ CORRECT LOGOUT -->
        <a class="dropdown-item" href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>

                </ul>
            </nav>

            {{-- PAGE CONTENT --}}
            @yield('content')

        </div>
    </div>
</div>

{{-- JS --}}


<script src="{{ asset('theme/dist-assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('theme/dist-assets/js/sb-admin-2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



@yield('script')
@stack('scripts')

</body>
</html>
