<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>

                <div class="card-body">

                    {{-- ✅ Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- 🔘 LOGIN TYPE --}}
                    <div class="mb-3">
                        <label class="me-3">
                            <input type="radio" name="login_type" value="email" checked>
                            Email & Password
                        </label>

                        <label>
                            <input type="radio" name="login_type" value="mobile">
                            Mobile & OTP
                        </label>
                    </div>

                    {{-- ✅ EMAIL LOGIN FORM --}}
                    <form method="POST"
                          action="{{ route('login.email.v2') }}"
                          id="emailLoginForm">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   name="email_id"
                                   class="form-control"
                                   placeholder="Enter email"
                                   value="{{ old('email_id') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Enter password"
                                   required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                    {{-- ✅ MOBILE OTP FORM --}}
                    <form method="POST"
                          action="{{ url('/send-otp-v2') }}"
                          id="mobileLoginForm"
                          style="display:none;">
                        @csrf

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text"
                                   name="mobile_no"
                                   class="form-control"
                                   placeholder="Enter 10 digit mobile number"
                                   maxlength="10"
                                   required>
                        </div>

                        <button class="btn btn-success w-100">
                            Send OTP
                        </button>
                    </form>

                </div>

                <div class="card-footer text-center">
                    <a href="{{ url('/signup-v2') }}">
                        Create New Account
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- 🔁 TOGGLE SCRIPT --}}
<script>
document.querySelectorAll('input[name="login_type"]').forEach(radio => {
    radio.addEventListener('change', function () {

        document.getElementById('emailLoginForm').style.display =
            this.value === 'email' ? 'block' : 'none';

        document.getElementById('mobileLoginForm').style.display =
            this.value === 'mobile' ? 'block' : 'none';
    });
});
</script>

</body>
</html>
