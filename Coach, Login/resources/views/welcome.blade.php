<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/HomeStyle.css') }}">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <title>ISKOLETA+</title>
</head>
<body>
    <nav class="navbar">
    @if(session('success'))
        <script>alert("{{ session('success') }}");</script>
    @endif
        <div class="nav-brand">
            <img src="{{ asset('images/Logo.png') }}" alt="ISKOLETA+ Logo" class="logo">
            <div class="nav-title">ISKOLETA+</div>
        </div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
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

    <section id="home">
        <div class="home-container">
            <div class="info">
                <div class="intro">
                    <h2 class="title">Join PUP Sports</h2>
                    <h5 class="description">Welcome to PUP Join Sports, your ultimate platform for seamless event management! Stay ahead with real-time updates, easy registrations, and a hassle-free experience. Let’s make every game unforgettable!</h5>
                </div>

                <div class="SignInUp">
                    <button><a href="{{ url('/register') }}">Register</a></button>
                </div>
            </div>

            <div class="Qoute">
                <h3 class="quote">"Winners never quit, quitters never win!"</h3>
            </div>
        </div>

        <div class="AthletesImageContainer">
            <img src="{{ asset('images/Athletes.png') }}" alt="PUP Athletes" class="AthletesImage">
        </div>
    </section>
    
    <section id="about">
        <div class="about-container">
            <h2>ISKOLETA+</h2>
            <p>ISKOLETA+ is your gateway to joining sports at Polytechnic University of the Philippines. We aim to connect students with various sports activities and provide a platform for engagement and participation.</p>
        </div>
        <div class="mission-vision">
            <h3>Mission</h3>
            <p>To promote sports and physical activities among students, fostering a healthy and active lifestyle.</p>
            
            <h3>Vision</h3>
            <p>To be the leading platform for sports engagement at PUP, encouraging inclusivity and participation in various athletic activities.</p>
        </div>
        <div class="offer">
            <h3>What We Offer</h3>
            <ul>
                <li>Information on various sports clubs and teams at PUP</li>
                <li>Updates on upcoming sports events and activities</li>
                <li>Resources for students to get involved in sports</li>
                <li>A community for sports enthusiasts at PUP</li>
            </ul>
        </div>
    </section>

    <section id="contact">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <p>If you have any questions or need assistance, feel free to reach out to us!</p>
            <p>Email: <a href="mailto:samplemail@mail.com">samplemail@mail.com</a></p>
            <p>Address: Polytechnic University of the Philippines, Sta. Mesa, Manila</p>
            <p>Phone: +63 912 345 6789</p>
            <p>Follow us on social media:</p>
        </div>
    </section>
</body>
</html>
