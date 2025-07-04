<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/LandingProfile.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Coaches</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="main-menu">
        <ul>
            <li class="home-subnav">
                <a href="{{ url('/sdpo/home') }}">
                    <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                    <span class="nav-text">Dashboard</span>
                </a> 
            </li>
            <li class="student-subnav">
                <a href="#">
                    <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                    <span class="nav-text">Student-Athlete</span>
                </a>          
            </li>
            <li class="coach-subnav">
                <a href="{{ url('/sdpo/coaches') }}">
                    <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i>
                    <span class="nav-text">Coaches</span>
                </a>
            </li>
            <li class="profile-subnav">
                <a href="{{ url('/sdpo/profile') }}">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li class="logout">
                <a href="{{ url('/') }}">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>  
        </ul>
    </nav>

    <div class="container profile-view">
        <h2>SDPO Admin Profile</h2>

        <div class="profile-card">
            <p class="profile-name">
                {{ $sdpo['fullname'] ?? 'Not set' }}
            </p>

            <div class="profile-details-row">
                <p><strong>Position:</strong> {{ $sdpo['position'] ?? 'Not set' }}</p>
                <p><strong>Email:</strong> {{ $sdpo['email'] ?? 'Not set' }}</p>
                <p><strong>Contact Number:</strong> {{ $sdpo['contact'] ?? 'Not set' }}</p>
            </div>
        </div>

        <a href="{{ url('/sdpo/setup-profile') }}" class="btn-gold">Edit Profile</a>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }
    </script>
</body>
</html>
