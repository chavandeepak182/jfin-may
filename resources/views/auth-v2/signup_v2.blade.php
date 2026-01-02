<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>User Registration</h4>
                </div>

                <div class="card-body">

                    {{-- ✅ SHOW VALIDATION ERRORS --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ✅ SHOW SUCCESS MESSAGE --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/register-v2') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input
                                type="text"
                                name="mobile_no"
                                class="form-control"
                                value="{{ old('mobile_no') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email_id"
                                class="form-control"
                                value="{{ old('email_id') }}">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ url('/login-mobile') }}">Login with OTP</a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
