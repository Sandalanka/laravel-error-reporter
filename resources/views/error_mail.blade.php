<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Error Notification</title>
</head>
<body>
    <h2>⚠️ Application Error Detected</h2>
    <p><strong>Message:</strong> {{ $message }}</p>
    <p><strong>File:</strong> {{ $file }}</p>
    <p><strong>Line:</strong> {{ $line }}</p>

    <p>Time: {{ now() }}</p>
</body>
</html>
