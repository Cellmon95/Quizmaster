<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="flex-container">
            @if ($result === 'correct')
            <h1>Correct</h1>
            @elseif ($result === 'incorrect')
            <h1>Incorrect</h1>
            @else
            <h1>Game Over</h1>
            @endif

            <form action="/game" method="GET">
                <input type="submit" value="Continue">
            </form>
        </div>
    </main>
</body>
</html>
