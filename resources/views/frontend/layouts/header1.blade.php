<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')" />
        <meta name="Keywords" content="@yield('keywords')">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/lib/animate/animate.min.css"/>
        <link href="{{ asset('theme') }}/frontend/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="{{ asset('theme') }}/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/style.css" rel="stylesheet">


        <!-- Cutomized Scripts and CSS -->
        <script src="@yield('scripts')"></script>
        <script src="@yield('scripts2')"></script>
        <link rel="stylesheet" href="@yield('links')"/>

        <link rel="icon" type="image/png" href="{{ asset('theme') }}/frontend//img/favicon.png">
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        
        <!-- Navbar & Hero End -->
        <nav class="nav">
            <div class="container-fluid">
                <div class="logo">
                    <a href="{{ asset('') }}" class="navbar-brand p-0">
                        <img src="{{ asset('theme') }}/frontend/img/logo-white.svg" alt="Logo" class="w-100">
                    </a>
                </div>
                <div id="mainListDiv" class="main_list">
                    <ul class="navlinks">
                        <li><a href="{{ asset('') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }}">HOME</a></li>
                        <li><a href="{{ url('about') }}" class="nav-item {{ Request::is('about') ? 'active' : '' }}">ABOUT</a></li>
                        <li>
                            <div class="nav-item dropdown">
                                <a href="{{ url('services') }}" class="nav-item dropdown-toggle {{ Request::is('services*') || Request::is('home-loan') || Request::is('loan-against-property') || Request::is('project-loan') || Request::is('overdraft-facility') || Request::is('lease-rental-discounting') || Request::is('msme-loan') ? 'active' : '' }}" data-bs-toggle="dropdown">
                                    SERVICES
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ url('home-loan') }}" class="dropdown-item {{ Request::is('home-loan') ? 'active' : '' }}">HOME LOAN</a>
                                    <a href="{{ url('loan-against-property')}}" class="dropdown-item {{ Request::is('loan-against-property') ? 'active' : '' }}">LOAN AGAINST PROPERTY</a>
                                    <a href="{{ url('project-loan')}}" class="dropdown-item {{ Request::is('project-loan') ? 'active' : '' }}">PROJECT LOAN</a>
                                    <a href="{{ url('overdraft-facility')}}" class="dropdown-item {{ Request::is('overdraft-facility') ? 'active' : '' }}">OVERDRAFT FACILITY</a>
                                    <a href="{{ url('lease-rental-discounting')}}" class="dropdown-item {{ Request::is('lease-rental-discounting') ? 'active' : '' }}">LEASE RENTAL DISCOUNTING</a>
                                    <a href="{{ url('msme-loan')}}" class="dropdown-item {{ Request::is('msme-loan') ? 'active' : '' }}">MSME LOAN</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ url('properties')}}" class="nav-item {{ Request::is('properties') ? 'active' : '' }}">PROPERTIES</a></li>
                        <li><a href="{{ url('referral-program')}}" class="nav-item {{ Request::is('referral-program') ? 'active' : '' }}">REFERRALS</a></li>
                        <li><a href="{{ url('contact')}}" class="nav-item {{ Request::is('contact') ? 'active' : '' }}">CONTACT</a></li>
                        <li>
                            <!-- Dropdown for Logged-in User -->
                            @if(Session::has('role_id') && Session::get('role_id') == 1)
                            <div class="dropdown profile-dash-drop ms-3">
                                <a href="#" class="profile-dash dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i>
                                    {{ explode(" ", Session::get('username'))[0] }}
                                </a>
                                <div class="dropdown-menu">
                                    <a href="/my-profile" class="dropdown-item">
                                        <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                                    </a>                                
                                    <a href="/logout" class="dropdown-item text-danger">
                                        <i class="fas fa-power-off me-2"></i> Logout
                                    </a>
                                </div>
                            </div>
                            @else
                            <!-- Login Button for Guests -->
                            <div class="nav-btn px-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary rounded-pill py-2 px-5 ms-3 flex-shrink-0">LOGIN</a>
                            </div>
                            @endif
                        </li>
                    </ul>
                </div>
                <span class="navTrigger">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </div>
        </nav>

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enquire Now</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center bg-primary">
                        <div class="input-group w-100 mx-auto d-flex">
                            <!-- <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i class="fa fa-search"></i></span> -->
                            <form action="{{ route('enquiry.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control border-0" id="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Phone" required>
                                            <label for="contact">Your Phone</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="amount" name="amount"  value="{{ old('amount') }}" placeholder="Amount" required>
                                            <label for="amount">Amount</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control border-0" id="message" name="message" placeholder="Leave a message here" style="height: 120px" required>{{ old('message') }}</textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-light w-50 py-2" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Modal Start -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0 pb-5">
                    <div class="modal-header">
                        <h4 class="modal-title" id="loginModal">LOGIN</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-100 mx-auto d-flex">
                            <div class="row text-center pt-3">
                                <div class="col-lg-6 border-end">
                                    <img src="{{ asset('theme') }}/frontend/img/loan.png" alt="Logo" class="w-50">
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/applyNow') }}"> For Finance</a>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('theme') }}/frontend/img/housing.png" alt="Logo" class="w-50">
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/applyNow') }}"> For Property</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- main content --}}
            <div class="main-content">
                @yield('content')
            </div>
        {{-- end main content --}}

        @include('frontend.layouts.footer') 
        
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/674454c34304e3196ae835c0/1idhem7ek';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
    
</html>