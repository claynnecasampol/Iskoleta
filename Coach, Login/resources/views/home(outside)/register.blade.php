<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/RegisterStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('images/Logo.png') }}" alt="ISKOLETA+ Logo" class="logo">
            <div class="nav-title">ISKOLETA+</div>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/Home.html#home') }}">Home</a></li>
            <li><a href="{{ url('/Home.html#about') }}">About</a></li>
            <li><a href="{{ url('/Home.html#contact') }}">Contact</a></li>
            <li class="login-dropdown">
                <a href="#">Login</a>
                <ul class="login-submenu">
                    <li><a href="{{ url('/stlogin') }}">Student Login</a></li>
                    <li><a href="{{ url('/coach/login') }}">Coach Login</a></li>
                    <li><a href="{{ url('/sdpologin') }}">SDPO Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Registration form -->
    <div class="full-screen-wrapper">
        <div class="form-container">
            <span class="close-btn" onclick="window.location.href='{{ url('/') }}'">&times;</span>

            <h1 class="register">Student-Athlete Registration</h1>

            <!-- Validation errors -->
            @if ($errors->any())
                <div class="alert-danger" style="background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li style="color: #721c24;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="Name">
                    <div class="input-group">
                        <label><b>First Name</b></label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <label><b>Last Name</b></label>
                        <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required>
                    </div>
                </div>

                <label><b>Age</b></label>
                <input type="number" name="age" value="{{ old('age') }}" placeholder="Age" required>

                <div class="acad-info">
                    <div class="acad-info-group">
                        <label><b>Academic Course</b></label>
                        <select name="course" required>
                            <option value="" disabled {{ old('course') ? '' : 'selected' }}>Select your course</option>
                            @foreach([
                                "BS Computer Science", "BS Information Technology", "BS Business Administration",
                                "BS Hospitality Management", "BS Tourism Management", "BS Accountancy",
                                "BS Mechanical Engineering", "BS Civil Engineering", "BS Electrical Engineering", "BS Architecture"
                            ] as $course)
                                <option value="{{ $course }}" {{ old('course') == $course ? 'selected' : '' }}>{{ $course }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="acad-info-group">
                        <label><b>Year Level</b></label>
                        <select name="year" required>
                            <option value="" disabled {{ old('year') ? '' : 'selected' }}>Select your year level</option>
                            @foreach(["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"] as $year)
                                <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label><b>School Email</b></label>
                <input type="email" name="schoolmail" value="{{ old('schoolmail') }}" placeholder="Enter your school email" required>

                <label><b>Password</b></label>
                <input type="password" id="psw" name="psw" placeholder="Enter Password" required>

                <label><b>Confirm Password</b></label>
                <input type="password" id="confirm_psw" name="psw_confirmation" placeholder="Confirm Password" required onkeyup="validatePassword()">

                <p id="error-message" style="color: red; font-size: 14px;"></p>

                <button class="btn" type="submit">Register</button>

                <span class="log">Already have an Account?
                    <a href="{{ url('/stlogin') }}" class="logHere"> Login</a>
                </span>
            </form>
        </div>
    </div>

    <script>
        function validatePassword() {
            let password = document.getElementById("psw").value;
            let confirmPassword = document.getElementById("confirm_psw").value;
            let errorMessage = document.getElementById("error-message");

            if (password !== confirmPassword) {
                errorMessage.textContent = "Passwords do not match!";
            } else {
                errorMessage.textContent = "";
            }
        }
    </script>
</body>
</html>
