<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Property Account</title>
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
    max-width:440px;
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

.btn-signup{
    height:48px;
    border-radius:10px;
    font-weight:600;
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
        Create Property Account
    </h3>
    <p class="text-center auth-sub mb-4">
        Sign up to manage your property listings
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

    <form method="POST" action="{{ route('property.signup.submit') }}">
        @csrf

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       required>
            </div>
        </div>

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
                       value="{{ old('mobile_no') }}"
                       required>
            </div>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email"
                       name="email_id"
                       class="form-control"
                       placeholder="Email Address"
                       value="{{ old('email_id') }}"
                       required>
            </div>
        </div>

        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Create Password"
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 btn-signup">
            <i class="fas fa-user-plus me-1"></i> Signup & Continue
        </button>
    </form>

    <hr class="my-4">

    <p class="text-center signup-link mb-0">
        Already have an account?
        <a href="{{ route('property.login') }}">
            Login here
        </a>
    </p>

</div>

</body>
</html>
