<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/game.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="flex-container">
            <h1>Question 1</h1>
            <p>{{ $question->question; }}</p>
            <form method="POST" action="/game/commit">
                @csrf
                <ul>
                    <li>
                        <input type="radio" name="submitedAnswer" value="alt1">
                        <label>{{ $question->alt1; }}</label>
                    </li>

                    <li>
                        <input type="radio" name="submitedAnswer" value="alt2">
                        <label>{{ $question->alt2; }}</label>
                    </li>
                    <li>
                        <input type="radio" name="submitedAnswer" value="alt3">
                        <label>{{ $question->alt3; }}</label>
                    </li>
                    <li>
                        <input type="radio" name="submitedAnswer" value="alt4">
                        <label>{{ $question->alt4; }}</label>
                    </li>
                </ul>

                <input type="submit" value="Submit">
                <input type="button" value="Quit">
            </form>
        </div>
    </main>
</body>
</html>
