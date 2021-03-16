<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>AprilSix</title>

    <!-- Favicon -->
    <meta name="theme-color" content="#00adef">
    <meta name="msapplication-TileColor" content="#00adef">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div>
    <div id="app">
        <app></app>
    </div>
</div>
@include('scripts')
</body>
</html>
