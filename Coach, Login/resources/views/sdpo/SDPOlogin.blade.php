<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/LoginStyle.css') }}">
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
                    <li><a href="{{ url('/sdpologin') }}">SDPO Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Login form -->
    <div class="full-screen-wrapper">
        <div class="form-container">
            <span class="close-btn" onclick="window.location.href='{{ url('/') }}'">&times;</span>
            <h1 class="login">SDPO Login</h1>

            <form method="POST" action="{{ url('/sdpologin') }}">
                @csrf
                <label for="orgid"><b>Organizational ID</b></label>
                <input type="text" name="orgid" placeholder="Enter your organizational ID" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" name="psw" placeholder="Enter Password" required>

                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
