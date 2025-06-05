<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>Hi {{ $name }},</p>

    <p>We received a request to reset your password. Click the link below to set a new password:</p>

    <p>
        <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    </p>

    <p>This link will expire in 24 hours.</p>

    <p>If you did not request this, please ignore this email.</p>

    <p>Thanks,<br>Your Support Team</p>
</body>
</html>
