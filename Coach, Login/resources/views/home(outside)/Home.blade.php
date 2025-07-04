<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Logo.png" type="image/png">
    <link rel="stylesheet" href="HomeStyle.css">
    <title>ISKOLETA+</title>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <img src="Logo.png" alt="ISKOLETA+ Logo" class="logo">
            <div class="nav-title">ISKOLETA+</div> <!-- Title separate from list -->
        </div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="login-dropdown">
                <a href="#" class="login-btn">Login</a>
                <ul class="login-submenu">
                    <li><a href="STLogin.html">Student Login</a></li>
                    <li><a href="SDPOLogin.html">SDPO Login</a></li>
                </ul>
             </li>
        </ul> 
    </nav>

    <section id="home" class="home">
        <div class="home-container">
            <div class="info">
                <div class="intro">
                    <h2 class="title">ISKOLETA+</h2>
                    <h5 class="description">
                    Welcome to PUP Sports, your ultimate platform for seamless sports management!
                    Stay ahead with real-time updates, easy registrations, and a hassle-free experience.
                    Let’s make every game unforgettable!
                    </h5>
                </div>

                <div class="SignInUp">
                    <a href="Register.html" class="button-link">Register</a>
                </div>

                <div class="Qoute">
                    <h3 class="quote">"Winners never quit, quitters never win!"</h3>
                </div>
            </div>

            <div class="AthletesImageContainer">
                <img src="Athletes.png" alt="PUP Athletes" class="AthletesImage" />
            </div>
        </div>
    </section>

    <div class="gradient-bridge"></div>

    <div class="gradient-wrapper">
        <section id="about" class="gradient1">
            <div class="about-container">
                <h2>ABOUT US</h2>
                <p>ISKOLETA+ is your gateway to joining sports at Polytechnic University of the Philippines. We aim to connect students with various sports activities and provide a platform for engagement and participation.</p>
            </div>

            <div class="mv-wrapper">
                <div class="mission-row">
                    <div class="mission">
                        <h2>OUR MISSION</h2>
                        <p>To promote sports and physical activities among students, fostering a healthy and active lifestyle.</p>
                    </div>
                    <div class="pic-side">
                        <img src="Pic1.png" alt="Mission" class="pic1" />
                    </div>
                </div>

                <div class="vision-row">
                    <div class="pic-side">
                        <img src="Pic2.png" alt="Vision" class="pic2" />
                    </div>
                    <div class="vision">
                        <h2>OUR VISION</h2>
                        <p>To be the leading platform for sports engagement at PUP, encouraging inclusivity and participation in various athletic activities.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="contact-container">
                <h2>Contact Us</h2>
                <p>If you have any questions or need assistance, feel free to reach out to us!</p>
                <p>Email: <a href="mailto:samplemail@mail.com">samplemail@mail.com</a></p>
                <p>Address: Polytechnic University of the Philippines, Sta. Mesa, Manila</p>
                <p>Phone: +63 912 345 6789</p>
            </div>
        </section>
    </div>
</body>
</html>