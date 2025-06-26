<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Hello {{ $user->name ?? 'User' }},</h2>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p>
        <a href="{{ $resetUrl }}" style="display:inline-block; padding:10px 20px; background-color:#3490dc; color:#fff; text-decoration:none;">
            Reset Password
        </a>
    </p>

    <p>This password reset link will expire in {{ $expire }} minutes.</p>

    <p>If you did not request a password reset, no further action is required.</p>

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
