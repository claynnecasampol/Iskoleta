<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/SPPStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>

<!-- Sidebar -->
<div class="nav-title">Athletic Profile</div>
<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="container">
    <nav class="main-menu">
        <ul>
            <li class="home-subnav">
                <a href="{{ url('/SAHome') }}">
                    <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="aprofile-subnav">
                <a href="{{ url('/SAProfile') }}">
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
                <a href="{{ route('personal.profile') }}">
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

<!-- Profile Info -->
<div class="profile">
    <div class="profile-left">
        <h1 class="athlete-name">
            {{ $student->first_name ?? '' }} {{ $student->last_name ?? 'Unnamed Athlete' }}
        </h1>

        <p><strong>School Email:</strong> {{ $student->school_email ?? 'Email not set' }}</p>
        <p><strong>Contact Number:</strong> {{ $student->contact ?? 'Not set' }}</p>
        <p><strong>Age:</strong> {{ $student->age ?? 'N/A' }}</p>
        <p><strong>Course:</strong> {{ $student->course ?? 'Not set' }}</p>
        <p><strong>Year Level:</strong> {{ $student->year_level ?? 'N/A' }}</p>
    </div>

    <div class="btn-row">
        <button type="button" class="btn" onclick="openVerificationForm()">Get Verified</button>
        <a href="{{ route('personal.profile.edit') }}" class="btn">Edit Profile</a>
    </div>

    <!-- Verification Form -->
    <div id="verificationForm" style="display:none; margin-top: 20px;">
        <h3>Coach Verification</h3>
        <div class="form-row">
            <div class="form-group">
                <label for="sport">Sport:</label>
                <select id="sport" name="sport" onchange="filterCoachesBySport()" required>
                    <option value="">Select Sport</option>
                    @php
                        $sports = $coaches->pluck('sport')->unique();
                    @endphp
                    @foreach($sports as $sport)
                        <option value="{{ $sport }}">{{ $sport }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="coach">Select Coach:</label>
                <select id="coach" name="coach" required>
                    <option value="">Select Coach</option>
                    @foreach($coaches as $coach)
                        <option value="{{ $coach->id }}" data-sport="{{ $coach->sport }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>
        <button type="button" class="submit-btn" onclick="submitVerification()">Submit to Coach</button>
        <p id="verificationStatus" style="margin-top: 10px;"></p>
    </div>
</div>

<!-- Sidebar & Verification Script -->
<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-active');
        document.querySelector('.main-menu').classList.toggle('active');
    }

    function openVerificationForm() {
        document.getElementById('verificationForm').style.display = 'block';
    }

    function submitVerification() {
        const sport = document.getElementById("sport").value.trim();
        const coach = document.getElementById("coach").value;

        if (!sport || !coach) {
            alert("Please fill in all fields.");
            return;
        }

        fetch("{{ url('/submit-verification') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: `sport=${encodeURIComponent(sport)}&coach=${encodeURIComponent(coach)}`
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("verificationStatus").innerText = "Pending Coach Verification";
            document.getElementById("sport").disabled = true;
            document.getElementById("coach").disabled = true;
        })
        .catch(() => {
            alert("Something went wrong. Please try again.");
        });
    }
</script>

<!-- Coach Filtering Script -->
<script>
function filterCoachesBySport() {
    const selectedSport = document.getElementById("sport").value;
    const coachSelect = document.getElementById("coach");

    Array.from(coachSelect.options).forEach(option => {
        const coachSport = option.getAttribute("data-sport");

        if (!coachSport || coachSport === selectedSport || option.value === "") {
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    });

    coachSelect.value = ''; // Reset selection
}
</script>

</body>
</html>
