@extends('layouts.coach')

@section('title', 'ISKOLETA+')

@section('content')
<div class="nav-title">Application</div>
<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- sidebar -->
<nav class="main-menu">
    <ul>
        <li class="home-subnav">
            <a href="{{ url('CHome') }}">
                <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="student-subnav">
            <a href="{{ route('coach.registered') }}">
                <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                <span class="nav-text">Student-Athlete</span>
            </a>
        </li>
        <li class="approval-subnav">
            <a href="{{ route('coach.pending') }}">
                <i class="fa-solid fa-list-check" style="color: #ffffff;"></i>
                <span class="nav-text">Application</span>
            </a>
        </li>
        <li class="profile-subnav">
            <a href="{{ route('coach.profile') }}">
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

<!-- student for verification profile -->
<div class="profile-view">
    <div class="profile-left">
        <h1 class="athlete-name">
            {{ $student['first_name'] ?? 'Unnamed Athlete' }} {{ $student['last_name'] ?? '' }}
        </h1>
        <p><strong>School Email:</strong> {{ $student['email'] ?? 'Email not set' }}</p>
    </div>

    <div class="profile-right">
        <p><strong>Age:</strong> {{ $student['age'] ?? '—' }}</p>
        <p><strong>Course:</strong> {{ $student['course'] ?? 'Not set' }}</p>
        <p><strong>Year Level:</strong> {{ $student['year_level'] ?? '—' }}</p>
    </div>

    <div class="button-row" style="margin-top: 25px;">
        <button type="button" id="viewAthleticInfo" class="btn-gold">Athletic Information</button>
    </div>

    <!-- athletic profile -->
    <div id="athleteProfile" style="display: none;">
        @if (!empty($athlete['photo']))
        <div class="form-group" style="text-align: center;">
            <img src="{{ asset('storage/' . $athlete['photo']) }}" alt="2x2 Profile Photo"
                style="width: 160px; height: 160px; object-fit: cover; border-radius: 8px; border: 2px solid #ccc;">
            <p style="margin-top: 8px; color: #ccc;">Uploaded 2"x2" ID Photo</p>
        </div>
        @endif

        <h2>I. Personal Profile</h2>
        <div class="form-row">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" value="{{ $athlete['lastname'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" value="{{ $athlete['firstname'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" value="{{ $athlete['middlename'] ?? 'Not set' }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label>Sport Affiliation</label>
            <input type="text" value="{{ $athlete['event'] ?? 'Not set' }}" readonly>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="text" value="{{ $athlete['bday'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="text" value="{{ $athlete['age'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>Height (cm)</label>
                <input type="text" value="{{ $athlete['height'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>Weight (kg)</label>
                <input type="text" value="{{ $athlete['weight'] ?? 'Not set' }}" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="text" value="{{ $athlete['schoolmail'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" value="{{ $athlete['contact'] ?? 'Not set' }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label>Home Address</label>
            <input type="text" value="{{ $athlete['home_address'] ?? 'Not set' }}" readonly>
        </div>

        <div class="form-group">
            <label>Provincial Address</label>
            <input type="text" value="{{ $athlete['provincial_address'] ?? 'Not set' }}" readonly>
        </div>

        <h2>II. Educational Background</h2>
        <div class="form-group">
            <label>Elementary</label>
            <input type="text" value="{{ $athlete['elemementary'] ?? 'Not set' }}" readonly>
        </div>
        <div class="form-group">
            <label>Secondary</label>
            <input type="text" value="{{ $athlete['secondary'] ?? 'Not set' }}" readonly>
        </div>
        <div class="form-group">
            <label>Senior High School</label>
            <input type="text" value="{{ $athlete['shs'] ?? 'Not set' }}" readonly>
        </div>
        <div class="form-group">
            <label>Previous Program (Transferee)</label>
            <input type="text" value="{{ $athlete['transferee'] ?? 'Not set' }}" readonly>
        </div>
        <div class="form-group">
            <label>SHS Track/Strand</label>
            <input type="text" value="{{ $athlete['track/strand'] ?? 'Not set' }}" readonly>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>G10 GWA</label>
                <input type="text" value="{{ $athlete['g10'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>G11 GWA</label>
                <input type="text" value="{{ $athlete['g11'] ?? 'Not set' }}" readonly>
            </div>
            <div class="form-group">
                <label>G12 GWA</label>
                <input type="text" value="{{ $athlete['g12'] ?? 'Not set' }}" readonly>
            </div>
        </div>

        <h2>III. Sports Participation</h2>
        @php
            $tournaments = $athlete['ntournament'] ?? [];
            $levels = $athlete['level'] ?? [];
            $years = $athlete['year'] ?? [];
            $awards = $athlete['awards'] ?? [];
        @endphp

        @if (!empty($tournaments))
            @foreach ($tournaments as $i => $tournament)
                <div class="form-row">
                    <div class="form-group">
                        <label>Name of Tournament</label>
                        <input type="text" value="{{ $tournament }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input type="text" value="{{ $levels[$i] ?? '—' }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" value="{{ $years[$i] ?? '—' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Awards</label>
                        <input type="text" value="{{ $awards[$i] ?? '—' }}" readonly>
                    </div>
                </div>
                <hr style="margin: 30px 0; border-color: #666;">
            @endforeach
        @else
            <p>No sports participation records found.</p>
        @endif

        <h2>IV. Vaccination & PhilHealth Info</h2>
        <div class="form-row">
            <div class="form-group">
                <label>Vaccination Status</label>
                <input type="text" value="{{ $athlete['vaccination'] ?? 'Not provided' }}" readonly>
            </div>
            <div class="form-group">
                <label>PhilHealth Card No.</label>
                <input type="text" value="{{ $athlete['philhealth'] ?? 'Not provided' }}" readonly>
            </div>
        </div>

        <h2>V. Preferred Program/Course</h2>
        <div class="form-group">
            <label>First Choice</label>
            <input type="text" value="{{ $athlete['first-choice'] ?? 'Not selected' }}" readonly>
        </div>
        <div class="form-group">
            <label>Second Choice</label>
            <input type="text" value="{{ $athlete['second-choice'] ?? 'Not selected' }}" readonly>
        </div>
        <div class="form-group">
            <label>Third Choice</label>
            <input type="text" value="{{ $athlete['third-choice'] ?? 'Not selected' }}" readonly>
        </div>

        <!-- Approve and reject button -->
        <div class="button-row" style="margin-top: 30px;">
            <button type="button" class="btn-gold">Approve</button>
            <button type="submit" class="btn-gold">Reject</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-active');
        document.querySelector('.main-menu').classList.toggle('active');
    }

    document.getElementById("viewAthleticInfo").addEventListener("click", function () {
        const fields = document.getElementById("athleteProfile");
        const isVisible = fields.style.display === "block";
        fields.style.display = isVisible ? "none" : "block";
        this.textContent = isVisible ? "Athletic Information" : "Hide Athletic Information";
    });
</script>
@endsection
