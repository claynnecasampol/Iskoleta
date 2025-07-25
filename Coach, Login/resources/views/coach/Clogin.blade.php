<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/LoginStyle.css') }}">
    <title>ISKOLETA+ Coach Login</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('images/Logo.png') }}" alt="ISKOLETA+ Logo" class="logo">
            <div class="nav-title">ISKOLETA+</div>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/#home') }}">Home</a></li>
            <li><a href="{{ url('/#about') }}">About</a></li>
            <li><a href="{{ url('/#contact') }}">Contact</a></li>
            <li class="login-dropdown">
                <a href="#" class="login-btn">Login</a>
                <ul class="login-submenu">
                    <li><a href="{{ url('/stlogin') }}">Student Login</a></li>
                    <li><a href="{{ url('/coach/login') }}">Coach Login</a></li>
                    <li><a href="{{ url('/sdpologin') }}">SDPO Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Login Form -->
    <div class="full-screen-wrapper">
        <div class="form-container">
            <span class="close-btn" onclick="window.location.href='{{ url('/') }}'">&times;</span>
            <h1 class="login">Coach Login</h1>

            @if(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ url('/coach/login') }}">
                @csrf
                <label for="email"><b>Email</b></label>
                <input type="text" name="email" placeholder="Enter your email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" name="password" placeholder="Enter Password" required>

                <span class="psw">
                    <a href="#" class="fpass">Forgot Password?</a>
                </span>

                <button class="btn" type="submit">Login</button>
                <span class="reg">No account yet?
                <a href="{{ url('/register') }}" class="regHere"> Register</a>
                </span>
            </form>
        </div>
    </div>
</body>
</html>
