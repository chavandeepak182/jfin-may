<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JFS Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('theme/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('theme/frontend/css/style.css') }}" rel="stylesheet">

        <style>
            a {
                text-decoration: none;
            }
            .login-page {
                width: 100%;
                height: 90vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background-image: url('{{ asset('theme/frontend/img/bg-reg.jpg') }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }
            .form-right i {
                font-size: 100px;
            }
        </style>
    </head>

    <body>
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light"> 
                    <a href="{{ asset('') }}" class="navbar-brand p-0">
                        <img src="{{ asset('theme') }}/frontend/img/logo-white.svg" alt="Logo" class="w-100">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-0 mx-lg-auto">
                            <a href="{{ url('/') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }}">HOME</a>
                            <a href="{{ url('about') }}" class="nav-item {{ Request::is('about') ? 'active' : '' }}">ABOUT</a>
                            <div class="nav-item dropdown">
                                <a href="{{ url('services') }}" class="nav-link nav-item" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle">SERVICES</span>
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
                            <a href="{{ url('properties')}}" class="nav-item {{ Request::is('properties') ? 'active' : '' }}">PROPERTIES</a>
                            <a href="{{ url('referral-program')}}" class="nav-item {{ Request::is('referral-program') ? 'active' : '' }}">REFERRALS</a>
                            <a href="https://jfinserv.com/blog/" class="nav-item {{ Request::is('blog') ? 'active' : '' }}">BLOGS</a>
                            <div class="nav-btn px-3">
                                <a href="{{ url('contact')}}" class="btn btn-primary rounded-0 py-2 px-4 ms-3 flex-shrink-0 nav-item {{ Request::is('contact') ? 'active' : '' }}">CONTACT</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Registration Form Start -->
        <div class="login-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bg-white shadow rounded">
                            <div class="row">
                                <div class="col-md-5" style="background-image: url(../theme/frontend/img/agreement.jpg); background-position: center; background-size: cover; background-repeat: no-repeat; border-radius: 10px 0px 0px 10px;"></div>
                                <div class="col-md-7 p-5">
                                    <h4 class="pb-3">Register Your Account</h4>

                                    <!-- Success and Error Messages -->
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
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
                                    <form action="{{ route('registerUser') }}" method="POST" class="row g-4">
                                        @csrf

                                        <div class="col-6">
                                            <label>Your Name<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" required>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Your Phone<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-telephone-fill"></i></div>
                                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Your Phone" required>
                                            </div>
                                            @error('mobile_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label>Your Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                                <input type="email" class="form-control @error('email_id') is-invalid @enderror" name="email_id" value="{{ old('email_id') }}" placeholder="Enter Your Email" required>
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
                                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
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
                                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password_confirmation">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-50 py-2" type="submit">Register Now</button>
                                        </div>
                                        <div class="col-12">
                                            <p>Already have an account?

                                            <a href="{{ route('login') }}">Login</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registration Form End -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');

    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = document.querySelector(button.getAttribute('data-target'));
            if (target.type === 'password') {
                target.type = 'text';
                button.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                target.type = 'password';
                button.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });
    });
});
</script>
    </body>
</html>
