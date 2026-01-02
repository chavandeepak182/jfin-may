<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }

        .otp-container {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-card {
            background: #ffffff;
            width: 360px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .otp-card h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .otp-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .otp-input {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            letter-spacing: 6px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .otp-input:focus {
            outline: none;
            border-color: #0066ff;
        }

        .btn-verify {
            width: 100%;
            padding: 12px;
            background: #0066ff;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-verify:hover {
            background: #004ecb;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .resend {
            margin-top: 15px;
            font-size: 13px;
        }

        .resend a {
            color: #0066ff;
            text-decoration: none;
            font-weight: bold;
        }

        .resend a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="otp-container">
    <div class="otp-card">

        <h3>Verify OTP</h3>
        <p>Please enter the 4-digit OTP sent to your mobile number</p>

        {{-- Error message --}}
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('authv3.otp.verify') }}">
            @csrf

            <input
                type="text"
                name="otp"
                maxlength="4"
                class="otp-input"
                placeholder="● ● ● ●"
                required
            >

            <button type="submit" class="btn-verify">
                Verify & Continue
            </button>
        </form>

        <div class="resend">
            Didn’t receive OTP?
            <a href="{{ route('authv3.otp.resend') }}">Resend OTP</a>
        </div>

    </div>
</div>

</body>
</html>
