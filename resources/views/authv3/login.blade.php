<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#eef2ff,#f8f9fa);
    font-family: 'Segoe UI', sans-serif;
}

.auth-card{
    max-width:420px;
    margin:80px auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.auth-card h3{
    font-weight:600;
    margin-bottom:20px;
}

.login-switch{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:20px;
}

.login-switch label{
    cursor:pointer;
    font-size:15px;
    font-weight:500;
}

.form-control{
    height:48px;
    border-radius:8px;
}

.btn-login{
    height:48px;
    border-radius:8px;
    font-weight:600;
}

.divider{
    text-align:center;
    margin:20px 0;
    position:relative;
}

.divider span{
    background:#fff;
    padding:0 10px;
    position:relative;
    z-index:1;
}

.divider::before{
    content:'';
    height:1px;
    background:#ddd;
    width:100%;
    position:absolute;
    top:50%;
    left:0;
}

.auth-footer{
    text-align:center;
    margin-top:20px;
    font-size:14px;
}
</style>

<script>
function toggleLogin(type){
    document.getElementById('emailBox').style.display = type === 'email' ? 'block' : 'none';
    document.getElementById('otpBox').style.display   = type === 'otp'   ? 'block' : 'none';
}
</script>

</head>
<body>

<div class="auth-card">

<h3 class="text-center">Welcome Back</h3>

{{-- Messages --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<!-- LOGIN TYPE SWITCH -->
<div class="login-switch">
<label>
<input type="radio" name="loginType" checked onclick="toggleLogin('email')">
 Email & Password
</label>

<label>
<input type="radio" name="loginType" onclick="toggleLogin('otp')">
 Mobile OTP
</label>
</div>

<!-- EMAIL LOGIN -->
<form method="POST" action="{{ route('authv3.login.email') }}" id="emailBox">
@csrf

<div class="mb-3">
<input type="email" name="email_id" class="form-control" placeholder="Email Address" required>
</div>

<div class="mb-3">
<input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

<button class="btn btn-primary w-100 btn-login">
<i class="fas fa-sign-in-alt me-1"></i> Login
</button>
</form>

<!-- OTP LOGIN -->
<form method="POST" action="{{ route('authv3.login.otp') }}" id="otpBox" style="display:none">
@csrf

<div class="mb-3">
<input type="text" name="mobile_no" class="form-control" placeholder="Mobile Number" maxlength="10" required>
</div>

<button class="btn btn-primary w-100 btn-login">
<i class="fas fa-paper-plane me-1"></i> Send OTP
</button>
</form>

<div class="divider"><span>OR</span></div>

<!-- SOCIAL (UI ONLY)
<a href="{{ route('authv3.google.login') }}"
   class="btn btn-outline-danger w-100 mb-2">
   <i class="fab fa-google me-2"></i> Continue with Google
</a> -->


<!-- <button class="btn btn-outline-primary w-100">
<i class="fab fa-facebook me-2"></i> Continue with Facebook
</button> -->

<div class="auth-footer">
New user?
<a href="{{ route('authv3.signup.form') }}">Create account</a>
</div>

</div>

</body>
</html>
