<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Exam Result</title>
</head>
<body>
    <h2>Mock Exam Result</h2>

    <p>Name: {{ $attempt->user->name }}</p>
    <p>Score: {{ $attempt->score }} / {{ $attempt->total }}</p>
    <p>Date: {{ $attempt->created_at }}</p>
</body>
</html>