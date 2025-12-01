<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        a { margin-right: 10px; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>My Application</h1>
    @yield('content')
</body>
</html>
