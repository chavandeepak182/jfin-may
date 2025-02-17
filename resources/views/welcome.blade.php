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
            @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

            * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            }

            section {
            position: relative;
            min-height: 90vh;
            background-image:url(../theme/frontend/img/bg-reg.jpg);;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-position: center; 
            background-size: cover; 
            background-repeat: no-repeat;
            }

            section .container {
            position: relative;
            width: 800px;
            height: 500px;
            background: #fff;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            }

            section .container .user {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            }

            section .container .user .imgBx {
            position: relative;
            width: 50%;
            height: 100%;
            background: #ff0;
            transition: 0.5s;
            }

            section .container .user .imgBx img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            }

            section .container .user .formBx {
            position: relative;
            width: 50%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            transition: 0.5s;
            }

            section .container .user .formBx form h2 {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
            color: #555;
            }

            section .container .user .formBx form input {
            position: relative;
            width: 100%;
            padding: 10px;
            background: #f5f5f5;
            color: #333;
            border: none;
            outline: none;
            box-shadow: none;
            margin: 8px 0;
            font-size: 14px;
            letter-spacing: 1px;
            font-weight: 300;
            }

            section .container .user .formBx form input[type='submit'] {
            max-width: 100px;
            background: #677eff;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            transition: 0.5s;
            }

            section .container .user .formBx form .signup {
            position: relative;
            margin-top: 20px;
            font-size: 12px;
            letter-spacing: 1px;
            color: #555;
            text-transform: uppercase;
            font-weight: 300;
            }

            section .container .user .formBx form .signup a {
            font-weight: 600;
            text-decoration: none;
            color: #677eff;
            }

            section .container .signupBx {
            pointer-events: none;
            }

            section .container.active .signupBx {
            pointer-events: initial;
            }

            section .container .signupBx .formBx {
            left: 100%;
            }

            section .container.active .signupBx .formBx {
            left: 0;
            }

            section .container .signupBx .imgBx {
            left: -100%;
            }

            section .container.active .signupBx .imgBx {
            left: 0%;
            }

            section .container .signinBx .formBx {
            left: 0%;
            }

            section .container.active .signinBx .formBx {
            left: 100%;
            }

            section .container .signinBx .imgBx {
            left: 0%;
            }

            section .container.active .signinBx .imgBx {
            left: -100%;
            }

            @media (max-width: 991px) {
            section .container {
                max-width: 400px;
            }

            section .container .imgBx {
                display: none;
            }

            section .container .user .formBx {
                width: 100%;
            }
            }
        </style>
    </head>
    <body>
        <!-- Navbar & Hero Start -->
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
        <!-- Navbar & Hero End -->    

        <!-- <div class="login-page bg-light" style="background-image: url(../theme/frontend/img/bg-reg.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bg-white shadow rounded">
                            <div class="row">
                                <div class="col-md-6 pe-0">
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="form-left h-100 py-5 px-5">
                                        <form class="row g-4" action="{{Route('userLogin')}}" method="post">
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

                                            <div class="col-12">
                                                <label>Username<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label>Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                    <label class="form-check-label" for="inlineFormCheck">Remember me</label>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <a href="{{route('forgot')}}" class="float-end text-primary">Forgot Password?</a>
                                                <a href="/registration" class="text-primary">Register an Account Now!</a></p>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-danger w-50 px-3 py-2 rounded-1 uppercase">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6" style="background-image: url(../theme/frontend/img/user-login.jpg); background-position: center; background-size: cover; background-repeat: no-repeat; border-radius: 0 10px 10px 0;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <section>
            <div class="container">
                <div class="user signinBx">                   
                <div class="imgBx"><img src="{{ asset('theme') }}/frontend/img/user-login.jpg" alt="" /></div>
                    <div class="formBx">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form  action="{{Route('userLogin')}}" method="post" class="row">
                            <h2>Sign In</h2>
                            @csrf
                            <div class="col-12">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 pb-3">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 pb-2">
                                <button type="submit" class="btn btn-dark px-4 py-2 rounded-1 uppercase">Login</button>
                            </div>
                            
                            <p class="signup">Don't have an account ? <a onclick="toggleForm();" style="cursor: pointer;">Sign Up.</a></p>
                        </form>
                    </div>
                </div>
                <div class="user signupBx">
                    <div class="formBx">
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
                        <form action="{{ route('registerUser') }}" method="POST" class="row">
                            <h2>Create an account</h2>
                            @csrf
                            <div class="col-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Your Phone" required>
                                @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="email" class="form-control @error('email_id') is-invalid @enderror" name="email_id" value="{{ old('email_id') }}" placeholder="Enter Your Email" required>
                                @error('email_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" required>
                                <div class="pos-ryt">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-type Password" required>
                                <div class="pos-ryt">
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password_confirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <button class="btn btn-dark px-4 py-2 rounded-1 uppercase" type="submit">Register Now</button>
                            </div>

                            <p class="signup">Already have an account ? <a onclick="toggleForm();" style="cursor: pointer;">Sign in.</a>                            </p>
                        </form>
                    </div>
                    <div class="imgBx"><img src="{{ asset('theme') }}/frontend/img/agreement.jpg" alt="" /></div>
                </div>
            </div>
        </section>

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

        <script>
            const toggleForm = () => {
            const container = document.querySelector('.container');
            container.classList.toggle('active');
            };
        </script>

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
