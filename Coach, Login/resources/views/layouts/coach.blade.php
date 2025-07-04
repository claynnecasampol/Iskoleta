<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/ApplicationStyle.css') }}">
    <title>@yield('title', 'ISKOLETA+')</title>
</head>
<body>
    <!-- sidebar -->
    <div class="nav-title">Application</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="main-menu">
        <ul>
            <li class="home-subnav">
                <a href="CHome.html">
                    <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="student-subnav">
                <a href="RegStudAthlete.html">
                    <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                    <span class="nav-text">Student-Athlete</span>
                </a>
            </li>
            <li class="approval-subnav">
                <a href="Application.html">
                    <i class="fa-solid fa-list-check" style="color: #ffffff;"></i>
                    <span class="nav-text">Application</span>
                </a>
            </li>
            <li class="profile-subnav">
                <a href="ProfileCoach.html">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li class="logout">
                <a href="/Home.html">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>  
        </ul>
    </nav>

    @yield('content')

    @yield('scripts')
</body>
</html>