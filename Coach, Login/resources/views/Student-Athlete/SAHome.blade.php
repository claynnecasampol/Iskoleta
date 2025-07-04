<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/SAHomeStyle.css') }}">
    <title>ISKOLETA+ | Dashboard</title>
</head>
<body>
    <!-- Sidebar Toggle Button -->
    <div class="nav-title">Dashboard</div>
    <button class="toggle-btn" id="toggleBtn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Sidebar Menu -->
    <div class="container">
        <nav class="main-menu" id="sidebarMenu">
            <ul>
                <li class="home-subnav">
                    <a href="{{ url('/sahome') }}">
                        <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                        <span class="nav-text">Dashboard</span>
                    </a> 
                </li>
                <li class="aprofile-subnav">
                    <a href="{{ route('athlete.profile.form') }}">
                        <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                        <span class="nav-text">Athletic Profile</span>
                    </a>          
                </li>
                <li class="agrades-subnav">
                    <a href="{{ url('/Grades') }}">
                        <i class="fa-solid fa-star" style="color: #ffffff;"></i>
                        <span class="nav-text">Academic Grades</span>
                    </a>
                </li>
                <li class="profile-subnav">
                    <a href="{{ url('/profile') }}">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                </li>
            <li class="logout">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </li>
            </ul>
        </nav>
    </div>

    <!-- Profile Summary Section -->
    <div class="profile-summary">
        <div class="profile-left">
            <h1 class="athlete-name">
                {{ $athlete['firstname'] ?? '' }} {{ $athlete['lastname'] ?? 'Unnamed Athlete' }}
            </h1>
            <p><strong>School Email:</strong> {{ $athlete['schoolmail'] ?? 'Email not set' }}</p>
        </div>

        <div class="profile-right">
            <p><strong>Age:</strong> {{ $athlete['age'] ?? 'N/A' }}</p>
            <p><strong>Course:</strong> {{ $athlete['course'] ?? 'Not set' }}</p>
            <p><strong>Year Level:</strong> {{ $athlete['year_level'] ?? 'Not set' }}</p>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('toggleBtn').addEventListener('click', function () {
            document.body.classList.toggle('sidebar-active');
            document.getElementById('sidebarMenu').classList.toggle('active');
        });
    </script>
</body>
</html>
