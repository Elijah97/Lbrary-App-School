<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    Hey {{ $name }},<br><br>

    This is to confirm your account activation on Library Platform.
    Click <a href="{{ $link }}">here</a> to activate your account. <br><br>

    <p>Use the following credentials to login</p>
    <p>Email: {{$email}}</p>
    <p>Password: {{$password}}</p>
    Cheers,
</body>

</html>