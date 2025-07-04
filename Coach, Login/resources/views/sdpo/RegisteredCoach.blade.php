<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/RegCoachStyle.css') }}">
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
                    <a href="#">
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
    </div>

    <div class="search-wrapper">
        <input type="text" id="coachSearch" placeholder="🔍 Search coaches by name, sport, or ID">
    </div>

    <div class="coach-table-container">
        <div class="coach-header">
            <h2>Registered Coach</h2>
            <a href="{{ url('/sdpo/create-coach') }}" class="add-coach">+ Add Coach</a>
        </div>

        <table class="coach-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>ORGANIZATIONAL ID</th>
                    <th>SPORT</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coaches as $coach)
                    <tr>
                        <td>{{ $coach->name }}</td>
                        <td>{{ $coach->org_id }}</td>
                        <td>{{ $coach->sport }}</td>
                        <td>
                            <a href="{{ url('/sdpo/view-coach/' . $coach->id) }}" class="action-view">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No coaches registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        document.getElementById("coachSearch").addEventListener("input", function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll(".coach-table tbody tr");

            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
            });
        });
    </script>
</body>
</html>
