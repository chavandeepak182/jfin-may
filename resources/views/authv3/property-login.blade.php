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
<<<<<<< HEAD
    background: linear-gradient(135deg,#eaf0ff,#f8f9fa);
    font-family:'Segoe UI', sans-serif;
}

/* MAIN WRAPPER */
.auth-wrapper{
    width:100%;
    max-width:900px;
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
=======
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
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
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
<<<<<<< HEAD

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

.bar1{height:40%}
.bar2{height:65%}
.bar3{height:55%}
.bar4{height:80%}
.bar5{height:60%}

/* MOBILE */
@media(max-width:768px){
    .auth-wrapper{
        flex-direction:column;
    }
    .auth-card,.auth-visual{
        width:100%;
    }
    .auth-visual{
        display:none;
    }
}
=======
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
</style>
</head>

<body>

<<<<<<< HEAD
<div class="auth-wrapper">

    <!-- LEFT : YOUR FORM (UNCHANGED LOGIC) -->
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

    <!-- RIGHT : STATIC PROPERTY DESIGN -->
    <div class="auth-visual">

        <h4 class="mb-4">Property Analytics</h4>

        <div class="visual-box">
            <div class="stat">
                <i class="fas fa-building"></i>
                <div>
                    <h6>Total Properties</h6>
                    <span>120 Listed</span>
                </div>
            </div>

            <div class="stat">
                <i class="fas fa-home"></i>
                <div>
                    <h6>Active Rentals</h6>
                    <span>86 Units</span>
                </div>
            </div>

            <div class="stat">
                <i class="fas fa-chart-line"></i>
                <div>
                    <h6>Monthly Growth</h6>
                    <span>+18%</span>
                </div>
            </div>
        </div>

        <div class="visual-box">
            <h6 class="mb-3">Property Performance</h6>
            <div class="graph">
                <div class="bar bar1"></div>
                <div class="bar bar2"></div>
                <div class="bar bar3"></div>
                <div class="bar bar4"></div>
                <div class="bar bar5"></div>
            </div>
        </div>

    </div>
=======
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
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa

</div>

</body>
</html>
