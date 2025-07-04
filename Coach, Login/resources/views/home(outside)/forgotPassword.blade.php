<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/Fpass.Style.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <!-- navigation bar -->
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

    <!-- Forgot Password form -->
    <div class="full-screen-wrapper">
        <div class="form-container">
            <h1 class="fpass">Forgot Password</h1>
            <form action="{{ url('/send-verification-code') }}" method="POST">
                @csrf
                <label for="schoolmail"><b>School Email</b></label>
                <input type="text" name="schoolmail" placeholder="Enter your school email" required>

                <button class="btn" type="submit">Send Verification Code</button>

                <span class="log">Back to <a href="{{ url('/home') }}" class="Home">Home</a></span>
            </form>
        </div>
    </div>
</body>
</html>
