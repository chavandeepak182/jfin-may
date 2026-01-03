<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Property Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg,#eef2ff,#f8f9fa);
    font-family:'Segoe UI', sans-serif;
}

.auth-card{
    width:100%;
    max-width:420px;
    background:#fff;
    padding:35px 30px;
    border-radius:16px;
    box-shadow:0 20px 45px rgba(0,0,0,.08);
}

.auth-title{
    font-weight:600;
    color:#333;
}

.auth-sub{
    font-size:14px;
    color:#6c757d;
}

.form-control{
    height:48px;
    border-radius:10px;
}

.btn-login{
    height:48px;
    border-radius:10px;
    font-weight:600;
}

.divider{
    text-align:center;
    margin:25px 0;
    position:relative;
}

.divider::before{
    content:"";
    position:absolute;
    left:0;
    top:50%;
    width:100%;
    height:1px;
    background:#e0e0e0;
}

.divider span{
    background:#fff;
    padding:0 12px;
    position:relative;
    font-size:13px;
    color:#888;
}

.signup-link a{
    text-decoration:none;
    font-weight:600;
}
</style>
</head>

<body>

<div class="auth-card">

    <h3 class="text-center auth-title mb-1">
        Login to continue
    </h3>
    <p class="text-center auth-sub mb-4">
        Enter your mobile number to receive OTP
    </p>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('property.login.otp') }}">
        @csrf

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-mobile-alt"></i>
                </span>
                <input type="text"
                       name="mobile_no"
                       class="form-control"
                       placeholder="Mobile Number"
                       maxlength="10"
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 btn-login">
            <i class="fas fa-paper-plane me-1"></i> Send OTP
        </button>
    </form>

    <div class="divider">
        <span>OR</span>
    </div>

    <p class="text-center signup-link mb-0">
        New user?
        <a href="{{ route('property.signup') }}">
            Create an account
        </a>
    </p>

</div>

</body>
</html>
