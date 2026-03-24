<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h3>Hello {{ $user->name }}</h3>

    <p>Your account has been created successfully.</p>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>

    <p>
        <a href="{{ url('/login') }}">Click here to login</a>
    </p>

    <p>Please change your password after login.</p>

    <p>Regards,<br>CBT System</p>
</body>
</html>