<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/SDPOHomeStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Dashboard</div>
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
                     <a href="{{ url('/sdpo/registered-athlete') }}">
                        <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                        <span class="nav-text">Student-Athlete</span>
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

    <div class="nav-container">
        <div class="nav-box">
            <h3>Athletes</h3>
            <p>View and manage detailed profiles of student-athletes.</p>
            <p>Total Registered: <span id="athlete-count" class="count-name">...</span></p>
            <button class="access" onclick="window.location.href='{{ url('/sdpo/registered-students') }}'">View Athletes</button>
        </div>

        <div class="nav-box">
            <h3>Coaches</h3>
            <p>View, add, and manage detailed coach profiles.</p>
            <p>Total Coaches: <span id="coach-count" class="count-name">...</span></p>
            <button onclick="window.location.href='{{ route('sdpo.registered.coach') }}'">View Coaches</button>
        </div>      
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ url("/api/get-total-athletes-sdpo") }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('athlete-count').textContent = data.count;
                })
                .catch(err => {
                    console.error('Athlete count error:', err);
                    document.getElementById('athlete-count').textContent = '0';
                });

            fetch('{{ url("/api/get-total-coaches") }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('coach-count').textContent = data.count;
                })
                .catch(err => {
                    console.error('Coach count error:', err);
                    document.getElementById('coach-count').textContent = '0';
                });
        });
    </script>
</body>
</html>
