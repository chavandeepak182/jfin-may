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
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
<!-- Topbar Start -->
        <div class="container-fluid topbar px-0 px-lg-4 bg-white py-2 d-none d-lg-block">
            <div class="container-fluid">
                <div class="row gx-0 align-items-center">
                    <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <div class="border-end border-primary pe-3">
                            <a href="tel:+918329729190" class="text-muted small"><i class="fas fa-phone text-primary me-2"></i>+91 83297 29190</a>
                            </div>
                            <div class="ps-3">
                                <a href="mailto:example@gmail.com" class="text-muted small"><i class="fas fa-envelope text-primary me-2"></i>info@jfinserv.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex border-end border-primary pe-3">
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn p-0 text-primary me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <div class="dropdown ms-3">
                                <a href="{{ route('loan.profile') }}" class="text-dark">
                                    <i class="fas fa-user text-primary me-2"></i>
                                        @if(Session::get('role_id') == 1)
                                            {{ explode(" ",Session::get('username'))[0] }} | <a href="/my-profile">Profile</a> | <a href="/logout"><i class="fas fa-power-off text-danger me-2"></i></a>
                                        @else
                                            Login
                                        @endif                                 
                                    
                                </a>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->
        

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{ asset('') }}" class="navbar-brand p-0">
                <img src="{{ asset('theme') }}/frontend/img/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-0 mx-lg-auto">
                    <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">HOME</a>
                    <a href="{{ url('about') }}" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">ABOUT</a>
                    <div class="nav-item dropdown">
                        <a href="{{ url('services') }}" class="nav-link dropdown-toggle {{ Request::is('services*') || Request::is('home-loan') || Request::is('loan-against-property') || Request::is('project-loan') || Request::is('overdraft-facility') || Request::is('lease-rental-discounting') || Request::is('msme-loan') ? 'active' : '' }}" data-bs-toggle="dropdown">
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
                    <a href="{{ url('properties')}}" class="nav-item nav-link {{ Request::is('properties') ? 'active' : '' }}">PROPERTIES</a>
                    <a href="{{ url('referral-program')}}" class="nav-item nav-link {{ Request::is('referral-program') ? 'active' : '' }}">REFERRALS</a>
                    <a href="https://jfinserv.com/blog/" class="nav-item nav-link" target="_blank">BLOGS</a>
                    <a href="{{ url('contact')}}" class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">CONTACT</a>
                    <div class="nav-btn px-3">
                        <a href="{{ url('applyNow')}}" class="btn btn-primary rounded-pill py-2 px-4 ms-3 flex-shrink-0">Apply Now</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
        <!-- Navbar & Hero End -->

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