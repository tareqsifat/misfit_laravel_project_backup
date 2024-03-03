<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Message</title>
</head>
<body>
    <div>
        <h3>Contact Message from {{ $mailData['name'] }}</h3>
    </div>

    <div>
        <p style="margin: 0;">User Name: {{ $mailData['name'] }}</p>
        <p style="margin: 0;">Email Address: {{ $mailData['email'] }}</p>
        <p style="margin: 0;">Message: {{ $mailData['message'] }}</p>
    </div>

    <p> ----- This is a system generated email. Please DO NOT reply. ----- </p>
</body>
</html>
