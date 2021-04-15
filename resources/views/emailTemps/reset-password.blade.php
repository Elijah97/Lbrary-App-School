<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    Hey {{ $name }},<br><br>

    You requested to reset your account password on ALU Library Platform.
    Click <a href="{{ $link }}/{{ $token }}">here</a> to reset your password. <br><br>

	Cheers,<br>
	
	<br><hr><br>
	<small>If you have not requested this action. Please ignore this email.</small>
</body>
</html>