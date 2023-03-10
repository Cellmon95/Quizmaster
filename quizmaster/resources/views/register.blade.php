<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/register.css">
    <title>Document</title>
</head>
<body>
    <main>
        <form class="flex-container" method="POST" action="/register/commit">
            @csrf
            <h1>Register</h1>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" >
            <label for="password">Password:</label>
            <input id="password" name="password" type="password" >
            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>
