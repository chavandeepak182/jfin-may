<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JFS Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/style.css" rel="stylesheet">

        <style>
                a {
                    text-decoration: none;
                }
                .login-page {
                    width: 100%;
                    height: 90vh;
                    display: inline-block;
                    display: flex;
                    align-items: center;
                }
                .form-right i {
                    font-size: 100px;
                }
        </style>
    </head>

    <body>
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

        <div class="login-page bg-light" style="background-image: url(../theme/frontend/img/bg-reg.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 mt-2">
                        <div class="bg-white shadow rounded">
                            <div class="row align-items-center p-5">
                                <div class="col-md-5 ps-0 d-none d-md-block">
                                    <div class="form-right h-100 text-white text-center">
                                        <a class="navbar-brand p-0">
                                            <!-- <h1 class="text-primary mb-0"><i class="fab fa-slack me-2"></i> LifeSure</h1> -->
                                            <img src="{{ asset('theme') }}/frontend/img/agreement.png" alt="Logo" style="width: 100%;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7 wow fadeInRight" data-wow-delay="0.4s">
                                    <div>
                                        <h4 class="pb-3">Register Your Account</h4>
                                        
                                        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

                                        <!-- Display validation errors -->
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <!-- Registration Form -->
                                        <form class="row g-4" action="{{ route('registerUser') }}" method="POST">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="col-6">
                                                <label>Your Name<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" required>
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-6">
                                                <label>Your Phone<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-telephone-fill"></i></div>
                                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Your Phone" required>
                                                </div>
                                                @error('mobile_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label>Your Email<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                                    <input type="email" class="form-control @error('email_id') is-invalid @enderror" name="email_id" id="email_id" value="{{ old('email_id') }}" placeholder="Enter Your Email" required>
                                                </div>
                                                @error('email_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-6">
                                                <label>Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" required>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-6">
                                                <label>Re-type Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-type Password" required>
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                            

                                            <div class="col-12">
                                                <button class="btn btn-primary w-50 px-4 py-2" type="submit">Register Now</button>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>Already have an account? <a href="/login" class="text-primary">Login</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="{{ asset('theme') }}/dist-assets/vendor/jquery/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
        <script>
            $("document").ready(function(){
                setTimeout(function(){
                $(".alert-danger").remove();
                }, 3000 ); // 3 secs

                setTimeout(function(){
                $(".alert-success").remove();
                }, 6000 );
            });
        </script>
        <script>
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>
        <script>
            $("document").ready(function(){

                var zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                $("#timezone").val(zone);
                console.log(zone);
                // $("#currentTimezone").val(zone);
            });
        </script>

    </body>
</html>
