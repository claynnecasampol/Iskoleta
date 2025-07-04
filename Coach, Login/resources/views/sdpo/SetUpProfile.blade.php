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
    <div class="nav-title">Profile</div>
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
                <a href="{{ url('/sdpo/profile/edit') }}">
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

    <div class="container">
        <h2>Set Up Your Profile</h2>

        <form action="{{ route('sdpo.profile.save') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Eg., Juan A. Dela Cruz" required value="{{ old('fullname', $sdpo->fullname ?? '') }}">
            </div>

            <div class="form-group">
                <label for="designation">Position</label>
                <input type="text" id="designation" name="designation" placeholder="Eg., Director" required value="{{ old('designation', $sdpo->position ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email">Official Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email', $sdpo->email ?? '') }}">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" required value="{{ old('contact', $sdpo->contact ?? '') }}">
            </div>

            <!-- Hidden Password Fields -->
            <div id="passwordFields" style="display: none; margin-top: 20px;">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="password_confirmation">
                </div>
            </div>

            <!-- Button Row -->
            <div class="button-row">
                <button type="button" id="togglePassword" class="btn-gold">Change Password</button>
                <button type="submit" class="btn-gold">Save Profile</button>
            </div>
        </form>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        document.getElementById("togglePassword").addEventListener("click", function () {
            const fields = document.getElementById("passwordFields");
            const isVisible = fields.style.display === "block";
            fields.style.display = isVisible ? "none" : "block";
            this.textContent = isVisible ? "Change Password" : "Cancel Password Change";
        });
    </script>
</body>
</html>
