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
        <div class="flex-container archiveContent" >
            <h1>Quizmaster</h1>
            @foreach ($questionViews as $questionView )
            <p>{{ $questionView['question'] }}: <span class="{{$questionView['result']}}">{{$questionView['result']}}</span></p>
            @endforeach
        </div>
    </main>
</body>
</html>
