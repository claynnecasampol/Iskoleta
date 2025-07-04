<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/CCoach.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Add Coach</div>
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
                    <a href="{{ url('/home') }}">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>  
            </ul>
        </nav>
    </div>

    <div class="form-wrapper">
        <form class="coach-form" method="POST" action="{{ url('/sdpo/save-coach') }}">
            @csrf
            <h2>Create Coach Account</h2>

            <div class="form-group">
                <label for="coach_name">Coach Full Name</label>
                <input type="text" id="coach_name" name="coach_name" placeholder="First Last" required>
            </div>

            <div class="form-group">
                <label for="coach_email">Email Address</label>
                <input type="email" id="coach_email" name="coach_email" placeholder="coach@email.com" required>
            </div>

            <div class="form-group">
                <label for="sport">Select Sport</label>
                <select name="sport" id="sport" required>
                    <option value="" disabled selected>Select your sport affiliation</option>
                    <option value="Basketball">Basketball</option>
                    <option value="Volleyball">Volleyball</option>
                    <option value="Swimming">Swimming</option>
                    <option value="Judo">Judo</option>
                    <option value="Football">Football</option>
                    <option value="Taekwondo">Taekwondo</option>
                    <option value="Table Tennis">Table Tennis</option>
                    <option value="Track and Field">Track and Field</option>
                    <option value="Chess">Chess</option>
                    <option value="Baseball">Baseball</option>
                    <option value="Softball">Softball</option>
                </select>
            </div>

            <div class="form-group">
                <label for="org_id">Organizational ID</label>
                <input type="text" id="org_id" name="org_id" placeholder="Enter org ID" required>
            </div>

            <div class="form-group">
                <label for="temp_password">Temporary Password</label>
                <input type="password" id="temp_password" name="temp_password" placeholder="Temporary password" required>
            </div>

            <button class="create" type="submit">Create Account</button>
        </form>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }
    </script>
</body>
</html>
