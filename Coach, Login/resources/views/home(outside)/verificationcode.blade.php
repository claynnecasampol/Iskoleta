<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/VcodeStyle.css') }}">
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

    <div class="full-screen-wrapper">
        <div class="form-container">
            <div class="title-container">
                <h1 class="vcode">Verification Code</h1>
                <p class="note">Please enter the 6-digit code sent to your registered email.</p>
            </div>

            <!-- Form for code input -->
            <form class="pin-form" method="POST" action="{{ url('/verify') }}" autocomplete="off">
                @csrf
                <div class="pin-inputs">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" name="code[]" maxlength="1" inputmode="numeric" pattern="[0-9]*" required>
                    @endfor
                </div>
                <div class="button-container">
                    <button class="btn" type="submit">Submit</button>
                    <button class="btn" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for input focus behavior -->
    <script>
        const inputs = document.querySelectorAll('.pin-inputs input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
</body>
</html>
