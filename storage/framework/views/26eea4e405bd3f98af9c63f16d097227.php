<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Hello <?php echo e($name); ?>,</h2>
    <p>Please click the button below to verify your email address:</p>
    <p>
        <a href="<?php echo e($verificationUrl); ?>" class="button">Verify Email Address</a>
    </p>
    <p>Or copy and paste this URL into your browser:<br>
    <code><?php echo e($verificationUrl); ?></code></p>
    <p>This link will expire in 24 hours.</p>
    <p>If you did not create an account, no further action is required.</p>
</body>
</html><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/emails/verify.blade.php ENDPATH**/ ?>