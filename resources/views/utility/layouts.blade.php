<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineLounge')</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/layouts-utility.css') }}">
</head>

<body>
    <style>
        body {
            margin: 0px;
            padding: 15px;
            min-height: 100vh;
            background: url({{ asset('image/bg2.webp') }}) no-repeat;
            background-size: cover;
            background-position: center;
            color: #FFF;
        }
    </style>
    @yield('content')
</body>

</html>
