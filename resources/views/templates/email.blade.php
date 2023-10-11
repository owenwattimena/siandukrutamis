<!DOCTYPE html>
<html>
<head>
    <title>{{ Config::get('app.name', '') }}</title>
</head>
<body>
    <h1>{{ $data['title'] }}</h1>
    <p>{{ $data['body'] }}</p>
</body>
</html>
