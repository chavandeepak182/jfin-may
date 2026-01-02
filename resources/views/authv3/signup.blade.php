<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Create Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ======= UI CSS (UNCHANGED FROM FIRST CODE) ======= */
        {{--
        NOTE: CSS short kela nahi, exactly same thevla ahe
        --}}
        body{margin:0}
        .register-page {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial;
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;display:flex;align-items:center;justify-content:center;
        }
        .auth-container{display:grid;grid-template-columns:1fr 1fr;max-width:1200px;width:100%;
            background:#fff;border-radius:20px;overflow:hidden;min-height:600px}
        .auth-illustration{background:linear-gradient(135deg,#667eea,#764ba2);
            display:flex;align-items:center;justify-content:center}
        .auth-form-section{padding:50px;overflow-y:auto}
        .auth-title{font-size:32px;font-weight:700;margin-bottom:20px}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .form-group{margin-bottom:20px}
        .form-group label{display:block;font-weight:600;margin-bottom:6px}
        .form-group input{width:100%;padding:12px;border:1px solid #ddd;border-radius:8px}
        .btn-signup{width:100%;padding:14px;background:#3b82f6;color:#fff;
            border:none;border-radius:8px;font-size:16px;font-weight:600}
        .btn-google{width:100%;padding:12px;border:1px solid #ddd;border-radius:8px;
            background:#fff;font-weight:600;margin-top:10px}
        .auth-footer{text-align:center;margin-top:20px}
        @media(max-width:968px){
            .auth-container{grid-template-columns:1fr}
            .auth-illustration{display:none}
            .form-row{grid-template-columns:1fr}
        }
    </style>
</head>

<body>

<div class="register-page">
    <div class="auth-container">

        <!-- LEFT UI -->
        <div class="auth-illustration"></div>

        <!-- RIGHT FORM -->
        <div class="auth-form-section">

            <h1>JFINSERV</h1>
            <h2 class="auth-title">Create Account</h2>

            {{-- ERROR --}}
            @if ($errors->any())
                <p style="color:red">{{ $errors->first() }}</p>
            @endif

            {{-- ✅ LARAVEL FORM --}}
            <form method="POST" action="{{ route('authv3.signup.submit') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Full Name" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_no" placeholder="Mobile Number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email_id" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn-signup">
                    Signup & Get OTP
                </button>
            </form>

            <hr>

            {{-- GOOGLE SIGNUP --}}
            <a href="{{ route('authv3.google.login') }}" class="btn-google">
                <i class="fab fa-google"></i> Sign up with Google
            </a>

            <div class="auth-footer">
                Already have an account?
                <a href="{{ route('authv3.login.form') }}">Login</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
