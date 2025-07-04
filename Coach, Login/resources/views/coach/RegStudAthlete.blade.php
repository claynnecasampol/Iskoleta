<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/CRegStudAthStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Student-Athlete</div>
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
    </div>

    <!-- search bar -->
    <div class="search-wrapper">
        <input type="text" id="coachSearch" placeholder="🔍 Search athletes by name, sport, or ID">
    </div>

    <!-- table -->
    <div class="coach-table-container">
        <div class="coach-header">
            <h2>Student-Athlete</h2>
        </div>

        <table class="coach-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>SPORT</th>
                    <th>COACH</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>

                    <td>
                        @if ($student->sport)
                            {{ $student->sport }}
                        @else
                            <span style="color: gray; font-style: italic;">Awaiting submission</span>
                        @endif
                    </td>

                    <td>
                        @if ($student->coach_name)
                            {{ $student->coach_name }}
                        @else
                            <span style="color: gray; font-style: italic;">Not assigned</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ url('coach/view-athlete/' . $student->id) }}" class="action-view">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <script>
        //sidebar script
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        //searchbar script
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
