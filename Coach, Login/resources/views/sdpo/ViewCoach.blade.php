<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/ViewCStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Coaches</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="container">
        <nav class="main-menu">
            <ul>
                <li class="home-subnav">
                    <a href="{{ url('/sdpo/home') }}">
                        <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                        <span class="nav-text">Dashboard</span>
                    </a> 
                </li>
                <li class="student-subnav">
                    <a href="{{ url('/sdpo/registered-students') }}">
                        <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                        <span class="nav-text">Student-Athlete</span>
                    </a>          
                </li>
                  <!-- New. Need to edit this -->
                <li class="grades-subnav">
                    <a href="GradesView.html">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                        <span class="nav-text">Grades</span>
                    </a>
                </li>
                <li class="coach-subnav">
                    <a href="{{ url('/sdpo/registered-coach') }}">
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
    </div>

    <a href="{{ url('/sdpo/registered-coach') }}" class="back-coach">Back to Coach List</a>

    <div class="profile-summary">
        <div class="profile-left">
            <h1 class="coach-name">
                {{ $coach->name ?? 'Unnamed Coach' }}
            </h1>

            <p><strong>Sport Affiliation:</strong>
                {{ $coach->sport ?? 'Not specified' }}
            </p>

            <p><strong>Email:</strong>
                {{ $coach->email ?? 'No email set' }}
            </p>
        </div>

        <div class="profile-right">
            <p><strong>Organizational ID:</strong>
                {{ $coach->org_id ?? 'N/A' }}
            </p>

            <p><strong>Contact Number:</strong>
                {{ $coach->number ?? 'No number on file' }}
            </p>

            <p><strong>Address:</strong>
                {{ $coach->address ?? 'No address provided' }}
            </p>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }
    </script>
</body>
</html>
