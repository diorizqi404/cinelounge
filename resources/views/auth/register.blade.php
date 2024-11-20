<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLounge | Register</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url({{ asset('image/bg1.webp') }});
            background-size: cover;
            background-position: center;
        }
    </style>
    <div class="wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('storeRegister') }}" method="POST">
            @csrf
            <h1>Sign Up</h1>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Username" name="username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                    <i class='bx bxs-lock'></i>
                </div>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>
