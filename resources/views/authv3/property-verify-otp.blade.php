<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verify OTP</title>
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

.otp-input{
    text-align:center;
    letter-spacing:12px;
    font-size:22px;
    height:54px;
    border-radius:12px;
}

.btn-verify{
    height:48px;
    border-radius:10px;
    font-weight:600;
}

.resend{
    font-size:14px;
}
</style>
</head>

<body>

<div class="auth-card">

    <h3 class="text-center auth-title mb-1">
        Verify OTP
    </h3>
    <p class="text-center auth-sub mb-4">
        Enter the 4-digit OTP sent to your mobile
    </p>

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('property.otp.verify') }}">
        @csrf

        <div class="mb-4">
            <input type="text"
                   name="otp"
                   class="form-control otp-input"
                   placeholder="● ● ● ●"
                   maxlength="4"
                   pattern="[0-9]{4}"
                   inputmode="numeric"
                   required>
        </div>

        <button type="submit" class="btn btn-success w-100 btn-verify">
            <i class="fas fa-check-circle me-1"></i> Verify & Continue
        </button>
    </form>

    <div class="text-center mt-4 resend">
        Didn’t receive OTP?
        <a href="{{ route('property.login') }}">Resend OTP</a>
    </div>

</div>

</body>
</html>
