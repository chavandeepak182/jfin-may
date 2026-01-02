<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Verify OTP</h4>
                </div>

                <div class="card-body">

                    {{-- ✅ show validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ✅ show error message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/verify-otp-v2') }}">
                        @csrf

                        {{-- ✅ VERY IMPORTANT --}}
                        <input type="hidden" name="mobile_no" value="{{ request('mobile_no') }}">

                        <div class="mb-3">
                            <label>Enter OTP</label>
                            <input
                                type="text"
                                name="otp"
                                class="form-control"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Verify & Login
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
