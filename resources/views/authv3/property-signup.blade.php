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
    background: linear-gradient(135deg,#eaf0ff,#f8f9fa);
    font-family:'Segoe UI', sans-serif;
}

/* MAIN WRAPPER */
.auth-wrapper{
    width:100%;
    max-width:950px;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,.1);
    display:flex;
}

/* LEFT FORM */
.auth-card{
    width:50%;
    padding:40px 35px;
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

/* RIGHT DESIGN */
.auth-visual{
    width:50%;
    background:linear-gradient(135deg,#4f46e5,#6366f1);
    color:#fff;
    padding:40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.visual-box{
    background:rgba(255,255,255,.12);
    border-radius:14px;
    padding:25px;
    margin-bottom:20px;
}

.stat{
    display:flex;
    align-items:center;
    margin-bottom:15px;
}

.stat i{
    font-size:22px;
    margin-right:12px;
}

.stat h6{
    margin:0;
    font-size:15px;
}

.stat span{
    font-size:13px;
    opacity:.9;
}

.graph{
    height:120px;
    display:flex;
    align-items:flex-end;
    gap:10px;
}

.bar{
    width:20%;
    background:#fff;
    border-radius:8px 8px 0 0;
}

.bar1{height:45%}
.bar2{height:70%}
.bar3{height:55%}
.bar4{height:85%}
.bar5{height:65%}

/* MOBILE */
@media(max-width:768px){
    .auth-wrapper{
        flex-direction:column;
    }
    .auth-card,
    .auth-visual{
        width:100%;
    }
    .auth-visual{
        display:none;
    }
}
</style>
</head>

<body>

<div class="auth-wrapper">

    <!-- LEFT : SIGNUP FORM (LOGIC UNCHANGED) -->
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

    <!-- RIGHT : STATIC PROPERTY DESIGN -->
    <div class="auth-visual">

        <h4 class="mb-4">Manage Properties Smartly</h4>

        <div class="visual-box">
            <div class="stat">
                <i class="fas fa-building"></i>
                <div>
                    <h6>Property Listings</h6>
                    <span>Add & manage properties</span>
                </div>
            </div>

            <div class="stat">
                <i class="fas fa-users"></i>
                <div>
                    <h6>Tenant Management</h6>
                    <span>Track tenants easily</span>
                </div>
            </div>

            <div class="stat">
                <i class="fas fa-chart-line"></i>
                <div>
                    <h6>Revenue Growth</h6>
                    <span>Monthly performance</span>
                </div>
            </div>
        </div>

        <div class="visual-box">
            <h6 class="mb-3">Property Growth Overview</h6>
            <div class="graph">
                <div class="bar bar1"></div>
                <div class="bar bar2"></div>
                <div class="bar bar3"></div>
                <div class="bar bar4"></div>
                <div class="bar bar5"></div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
