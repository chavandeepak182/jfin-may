<!DOCTYPE html>
<html lang="en">
<head>
    <title>JFS Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="{{ asset('theme') }}/main_style.css" rel="stylesheet" />

  <style>
            a {
            text-decoration: none;
        }
        .login-page {
            width: 100%;
            height: 100vh;
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

    <div class="login-page bg-light"  style="background-image: url(../theme/frontend/img/bg-reg.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-6 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    
                                    <form class="row g-4" action="{{Route('userLogin')}}" method="post">
                                        @csrf

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
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

                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Username" value="{{ old('email') }}">
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
                                            <button type="submit" class="btn btn-primary w-50 px-4 py-2">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center shadow align-items-center">
                                    <a href="/" class="navbar-brand p-0">
                                        <!-- <h1 class="text-primary mb-0"><i class="fab fa-slack me-2"></i> LifeSure</h1> -->
                                        <img src="{{ asset('theme') }}/frontend/img/user_login.png" alt="Logo" class="w-100">
                                    </a>
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
