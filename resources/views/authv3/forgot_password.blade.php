<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }

        .forgot-container {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .forgot-card {
            background: #ffffff;
            width: 360px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .forgot-card h3 {
            margin-bottom: 8px;
            color: #333;
        }

        .forgot-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-size: 13px;
            font-weight: bold;
            color: #444;
            margin-bottom: 6px;
            margin-top: 14px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #0066ff;
            box-shadow: 0 0 0 2px rgba(0,102,255,0.15);
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
            margin-top: 20px;
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
    </style>
</head>

<body>

<div class="forgot-container">
    <div class="forgot-card">

        <h3>Forgot Password</h3>
        <p>Enter your registered mobile number</p>

        {{-- Error message --}}
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <!-- ❌ FORM NOT CHANGED AT ALL -->
        <form method="POST" action="{{ route('authv3.forgot.submit') }}">
        @csrf

        <label>Registered Mobile Number</label>
        <input type="text" name="mobile_no" maxlength="10" required>

        <button class="btn-verify">Send OTP</button>
        </form>

    </div>
</div>

</body>
</html>
