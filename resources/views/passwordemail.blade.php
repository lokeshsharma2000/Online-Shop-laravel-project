<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>

    <h1>Password Reset Request</h1>
    <p>Hi,</p>
    <p>We received a request to reset your password for your account associated with this email: {{ $email }}.</p>
    <h1>Password Reset OTP</h1>
    <p>Your OTP for resetting your password is: <strong>{{ $otp }}</strong></p>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>Thank you!</p>
</body>
</html>