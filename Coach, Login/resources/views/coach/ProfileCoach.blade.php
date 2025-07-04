<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('LandingProfile.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Profile</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="main-menu">
        <ul>
            <li class="home-subnav">
                <a href="{{ url('CHome') }}">
                    <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                    <span class="nav-text">Dashboard</span>
                </a> 
            </li>
            <li class="student-subnav">
                <a href="{{ url('RegStudAthlete') }}">
                    <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                    <span class="nav-text">Student-Athlete</span>
                </a>          
            </li>
            <!-- New. Need to edit this -->
            <li class="grades-subnav">
                <a href="GradesView.html">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                        <span class="nav-text">
                            Grades
                        </span>
                    </a>
            </li>
            <li class="approval-subnav">
                <a href="{{ url('Application') }}">
                    <i class="fa-solid fa-list-check" style="color: #ffffff;"></i>
                    <span class="nav-text">Application</span>
                </a>
            </li>
            <li class="profile-subnav">
                <a href="{{ url('ProfileCoach') }}">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li class="logout">
                <a href="{{ url('/home') }}">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>  
        </ul>
    </nav>

    <div class="container profile-view">
        <h2>Coach Admin Profile</h2>

        <div class="profile-card">
            <p class="profile-name">
                {{ $coach['fullname'] ?? 'Not set' }}
            </p>

            <div class="profile-details-row">
                <p><strong>Sport Affiliation:</strong>
                    {{ !empty($coach['sport']) ? $coach['sport'] : 'Not specified' }}
                </p>
                <p><strong>Email:</strong>
                    {{ !empty($coach['email']) ? $coach['email'] : 'No email set' }}
                </p>
                <p><strong>Contact Number:</strong>
                    {{ $sdpo['contact'] ?? 'Not set' }}
                </p>
            </div>

            <div class="profile-details-row">
                <p><strong>Contact Number:</strong>
                    {{ $sdpo['contact'] ?? 'Not set' }}
                </p>
                <p><strong>Address:</strong>
                    {{ !empty($coach['address']) ? $coach['address'] : 'No address provided' }}
                </p>
            </div>
        </div>

        <a href="{{ url('SetUpProfile') }}" class="btn-gold">Edit Profile</a>
    </div>        

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }
    </script>
</body>
</html>
