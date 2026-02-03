<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>

    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }

        .reset-container {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-card {
            background: #ffffff;
            width: 360px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .reset-card h3 {
            margin-bottom: 8px;
            color: #333;
        }

        .reset-card p {
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

        /* Password wrapper for eye icon */
        .password-wrapper {
            position: relative;
        }

        input[type="password"],
        input[type="text"] {
            width: 90%;
            padding: 12px 40px 12px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #0066ff;
            box-shadow: 0 0 0 2px rgba(0,102,255,0.15);
        }

        .password-wrapper i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            font-size: 15px;
        }

        .password-wrapper i:hover {
            color: #0066ff;
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
    </style>
</head>

<body>

<div class="reset-container">
    <div class="reset-card">

        <h3>Reset Password</h3>
        <p>Please enter your new password</p>

        <!-- ❌ FORM NOT CHANGED -->
        <form method="POST" action="{{ route('authv3.reset.submit') }}">
        @csrf

        <label>New Password</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <i class="fa-solid fa-eye" onclick="togglePassword('password', this)"></i>
        </div>

        <label>Confirm Password</label>
        <div class="password-wrapper">
            <input type="password" name="password_confirmation" id="confirmPassword" required>
            <i class="fa-solid fa-eye" onclick="togglePassword('confirmPassword', this)"></i>
        </div>

        <button class="btn-verify">Reset Password</button>
        </form>

    </div>
</div>

<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>
