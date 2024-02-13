<!DOCTYPE html>
<html>
<head>
    <title>Storii</title>
</head>
<body>
    <h1>{{ $emailData['title'] }}</h1>
    <p>{{ $emailData['body'] }}</p>

    <p>Thank you</p>

    <p>
    If you want to unsubscribe please click here --- <a href="http://localhost:8000/unsubscribe?email={{$emailData['to']}}">Unsubscribe</a>
    </p>
</body>
</html>