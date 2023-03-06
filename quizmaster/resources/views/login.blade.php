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
@if ( isset($error) )
    <p>{{ $error }}</p>
@endif

    <main>
        <form class="flex-container" method="POST" action="/login/commit">
            @csrf
            <h1>Login</h1>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <label for="password">Password:</label>
            <input id="password" name="password" type="password" >
            <input type="submit" value="Login">
        </form>
    </main>
</body>
</html>
