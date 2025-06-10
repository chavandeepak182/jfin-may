<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Account Credentials</title>
</head>
<body>
    <h2>Hello {{ $user['name'] }},</h2>

    <p>Your account has been created successfully. Here are your login credentials:</p>

    <p><strong>Email:</strong> {{ $user['email_id'] }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>

    <p>Please keep this information safe and change your password after your first login.</p>

    <p>Thank you,<br>Jfinserv Team</p>
</body>
</html>