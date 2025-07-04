<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/CHomeStyle.css') }}">
    <title>ISKOLETA+</title>
</head>


<body>
    <!-- sidebar -->
    <div class="nav-title">Dashboard</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="container">
        <nav class="main-menu">
            <ul>
                <li class="home-subnav">
                    <a href="{{ url('CHome') }}">
                        <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="student-subnav">
                    <a href="{{ route('coach.registered') }}" class="access">View Athletes</a>
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
    </div>

    <div class="nav-container">
        <div class="nav-box">
            <h3>Athletes</h3>
            <p>View and manage detailed profiles of student-athletes.</p>
            <p>Total Registered: <span id="athlete-count" class="count-name">...</span></p>
            <a href="{{ route('coach.registered') }}" class="access">View Athletes</a>
        </div>

        <div class="nav-box">
            <h3>Pending Approval</h3>
            <p>Student-athlete applications are pending verification for approval.</p>
            <p>Request Pending: <span id="pending-count" class="count-name">...</span></p>
            <a href="{{ route('coach.pending') }}" class="access">View Athletes</a>
        </div>      
    </div>
   
    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        function loadDashboardCounts() {
            fetch('{{ url('/api/get-athlete-count.php') }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('athlete-count').textContent = data.count;
                })
                .catch(err => {
                    console.error('Athlete count error:', err);
                    document.getElementById('athlete-count').textContent = '0';
                });

            fetch('{{ url('/api/get-pending-count.php') }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('pending-count').textContent = data.count;
                })
                .catch(err => {
                    console.error('Pending count error:', err);
                    document.getElementById('pending-count').textContent = '0';
                });
        }

        document.addEventListener('DOMContentLoaded', loadDashboardCounts);
    </script>
</body>
</html>
