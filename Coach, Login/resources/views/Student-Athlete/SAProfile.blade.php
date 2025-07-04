<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/SAPStyle.css') }}">
    <title>ISKOLETA+ | Athletic Profile</title>
</head>
<body>
@php
    $isLocked = isset($profile) && in_array($profile->status, ['pending', 'approved']);
@endphp

<!-- Sidebar -->
<div class="nav-title">Athletic Profile</div>
<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="container">
    <nav class="main-menu">
        <ul>
            <li class="home-subnav">
                <a href="{{ url('/SAHome') }}"><i class="fa-solid fa-house"></i><span class="nav-text">Dashboard</span></a>
            </li>
            <li class="aprofile-subnav">
                <a href="{{ url('/SAProfile') }}"><i class="fa-solid fa-person-walking"></i><span class="nav-text">Athletic Profile</span></a>
            </li>
            <li class="agrades-subnav">
                <a href="{{ url('/Grades') }}"><i class="fa-solid fa-star">
                    </i><span class="nav-text">Academic Grades</span></a>
            </li>
            <li class="profile-subnav">
                <a href="{{ route('personal.profile') }}">
                </i><span class="nav-text">Profile</span></a>
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

@if(session('success'))
    <script>alert("{{ session('success') }}");</script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="athleteForm" action="{{ route('athlete.profile.submit') }}" method="POST" enctype="multipart/form-data" class="athlete-form">
    @csrf

    <!-- Upload Photo -->
    @php
        $photoPath = $profile->photo ?? $student->photo ?? null;
    @endphp

    @if (!$isLocked)
        <input type="file"
            id="photo"
            name="photo"
            accept="image/*"
            {{ ($photoPath) ? '' : 'required' }}>

        @if ($photoPath)
            <div style="margin-top: 10px;">
                <img src="{{ asset('storage/' . $photoPath) }}"
                    alt="Uploaded Photo"
                    style="max-width: 150px; border: 1px solid #ccc; padding: 5px;">
            </div>
        @endif
    @else
        @if ($photoPath)
            <div style="margin-top: 10px;">
                <img src="{{ asset('storage/' . $photoPath) }}"
                    alt="Uploaded Photo"
                    style="max-width: 150px; border: 1px solid #ccc; padding: 5px;">
            </div>
        @else
            <p style="font-style: italic; color: #555;">No uploaded photo available.</p>
        @endif
    @endif


    <!-- Personal Profile -->
    <h2>I. Personal Profile</h2>
    <div class="form-row">
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" placeholder="Dela Cruz" value="{{ old('lastname', $profile->last_name ?? $student->last_name ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" placeholder="Juan" value="{{ old('firstname', $profile->first_name ?? $student->first_name ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" name="middlename" placeholder="Santos" value="{{ old('middlename', $profile->middle_name ?? $student->middle_name ?? '') }}" {{ $isLocked ? 'readonly' : '' }}>
        </div>
    </div>

    <!-- Event -->
    <div class="form-group">
        <label for="event">Event</label>
        <input type="text" name="event" placeholder="Please specify your specialization" value="{{ old('event', $profile->event ?? $student->event ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <!-- Personal Info -->
    <div class="form-row">
        <div class="form-group">
            <label for="bday">Date of Birth</label>
            <input type="date" id="bday" name="birth_date" value="{{ old('birth_date', $profile->birth_date ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="{{ old('age', $student->age ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="height">Height (cm)</label>
            <input type="number" id="height" name="height" value="{{ old('height', $profile->height ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="weight">Weight (kg)</label>
            <input type="number" id="weight" name="weight" value="{{ old('weight', $profile->weight ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="form-row">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $profile->email ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" name="contact" value="{{ old('contact', $profile->contact ?? $student->contact ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
        </div>
    </div>

    <!-- Address Section -->
    <div class="form-group">
        <label for="home_address">Home Address</label>
        <input type="text" id="home_address" name="home_address" placeholder="e.g., 123 Main St., Manila" value="{{ old('home_address', $profile->home_address ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <div class="form-group">
        <label for="provincial_address">Provincial Address</label>
        <input type="text" id="provincial_address" name="provincial_address" placeholder="e.g., Brgy. San Jose, Quezon Province" value="{{ old('provincial_address', $profile->provincial_address ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <!-- Vaccination -->
    <div class="form-row">
        <div class="form-group">
            <label for="vax">Vaccination</label>
            <select id="vax" name="vaccination" {{ $isLocked ? 'disabled' : '' }} required>
                <option value="" disabled {{ old('vaccination', $profile->vaccination ?? '') == '' ? 'selected' : '' }}>Select vaccination status</option>
                <option value="1st Dose" {{ old('vaccination', $profile->vaccination ?? '') == '1st Dose' ? 'selected' : '' }}>1st Dose</option>
                <option value="2nd Dose" {{ old('vaccination', $profile->vaccination ?? '') == '2nd Dose' ? 'selected' : '' }}>2nd Dose</option>
                <option value="Booster" {{ old('vaccination', $profile->vaccination ?? '') == 'Booster' ? 'selected' : '' }}>Booster</option>
                <option value="Not Vaccinated" {{ old('vaccination', $profile->vaccination ?? '') == 'Not Vaccinated' ? 'selected' : '' }}>Not Vaccinated</option>
            </select>
            @if ($isLocked)
                <input type="hidden" name="vaccination" value="{{ old('vaccination', $profile->vaccination ?? '') }}">
            @endif
        </div>
        <div class="form-group">
            <label for="philhealth">PhilHealth Card No.</label>
            <input type="text" name="philhealth"
       value="{{ old('philhealth', $profile->philhealth ?? '') }}"
       @if(isset($profile) && in_array($profile->status, ['pending', 'approved'])) readonly @endif>
        </div>
    </div>

    <!-- Educational Background -->
    <h2>II. Educational Background</h2>
    <div class="form-group">
        <label for="elementary">Elementary</label>
        <input type="text" name="elementary" value="{{ old('elementary', $profile->elementary ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>
    <div class="form-group">
        <label for="secondary">Secondary</label>
        <input type="text" name="secondary" value="{{ old('secondary', $profile->secondary ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>
    <div class="form-group">
        <label for="shs">Senior High School</label>
        <input type="text" name="shs" value="{{ old('shs', $profile->shs ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <!-- Transferee Information -->
    <div class="form-group">
        <label style="display: flex; align-items: center; gap: 10px;">
            @if (!$isLocked)
                <!-- This ensures we send 0 if the box is unchecked -->
                <input type="hidden" name="is_transferee" value="0">
            @endif

            <!-- Actual Checkbox -->
            <input type="checkbox" id="isTransferee" name="is_transferee" value="1"
                {{ old('is_transferee', $profile->is_transferee ?? false) ? 'checked' : '' }}
                {{ $isLocked ? 'disabled' : '' }}>

            <span>I am a transferee</span>
        </label>

        @if ($isLocked)
            <!-- Persist hidden value if locked -->
            <input type="hidden" name="is_transferee"
                value="{{ old('is_transferee', $profile->is_transferee ?? false) ? '1' : '0' }}">
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.getElementById('isTransferee').addEventListener('click', e => e.preventDefault());
                });
            </script>
        @endif
    </div>

    <div class="form-group">
        <label for="transferee">If Transferee (Please specify your previous program)</label>
        <input type="text" id="transfereeField" name="transferee"
            value="{{ old('transferee', $profile->transferee ?? '') }}"
            placeholder="If applicable"
            {{ $isLocked ? 'readonly' : '' }}>
    </div>

    <!-- Senior High School Track/Strand -->
    <div class="form-group">
        <label for="track_strand">Senior High School Track/Strand</label>
        <input type="text" name="track_strand" placeholder="e.g., Science, Technology, Engineering, and Mathematics" value="{{ old('track_strand', $profile->track_strand ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="g10">G-10 GWA</label>
            <input type="number" id="g10" name="g10" step="0.01"
                value="{{ old('g10', $profile->g10 ?? '') }}"
                {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="g11">G-11 GWA</label>
            <input type="number" id="g11" name="g11" step="0.01"
                value="{{ old('g11', $profile->g11 ?? '') }}"
                {{ $isLocked ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="g12">G-12 GWA</label>
            <input type="number" id="g12" name="g12" step="0.01"
                value="{{ old('g12', $profile->g12 ?? '') }}"
                {{ $isLocked ? 'readonly' : '' }} required>
        </div>
    </div>

    <!-- Sports Participation -->
    <h2>III. Sports Participation</h2>
    <div id="tournament-entries">
        @php
            $tournaments = $tournaments ?? collect();
            $tournamentNames = old('ntournament', $tournaments->pluck('tournament_name')->toArray() ?: ['']);
            $levels = old('level', $tournaments->pluck('level')->toArray() ?: ['']);
            $years = old('year', $tournaments->pluck('year')->toArray() ?: ['']);
            $awards = old('awards', $tournaments->pluck('awards')->toArray() ?: ['']);
        @endphp

        @foreach ($tournamentNames as $i => $tournament)
        <div class="form-row">
            <div class="form-group">
                <label for="ntournament_{{ $i }}">Name of Tournament</label>
                <input type="text" name="ntournament[]" id="ntournament_{{ $i }}"
                    value="{{ $tournament }}"
                    {{ $isLocked ? 'readonly' : '' }}>
            </div>
            <div class="form-group">
                <label for="level_{{ $i }}">Level</label>
                <select id="level_{{ $i }}" name="level[]" {{ $isLocked ? 'disabled' : '' }}>
                    <option value="" disabled {{ empty($levels[$i]) ? 'selected' : '' }}>Select Level</option>
                    <option value="International" {{ ($levels[$i] ?? '') == 'International' ? 'selected' : '' }}>International</option>
                    <option value="National" {{ ($levels[$i] ?? '') == 'National' ? 'selected' : '' }}>National</option>
                    <option value="Regional" {{ ($levels[$i] ?? '') == 'Regional' ? 'selected' : '' }}>Regional</option>
                    <option value="Local" {{ ($levels[$i] ?? '') == 'Local' ? 'selected' : '' }}>Local</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year_{{ $i }}">Year</label>
                <input type="number" name="year[]" id="year_{{ $i }}"
                    value="{{ $years[$i] ?? '' }}"
                    {{ $isLocked ? 'readonly' : '' }}>
            </div>
            <div class="wide-field">
                <label for="awards_{{ $i }}">Awards/Recognition received</label>
                <input type="text" name="awards[]" id="awards_{{ $i }}"
                    value="{{ $awards[$i] ?? '' }}"
                    {{ $isLocked ? 'readonly' : '' }}>
            </div>
        </div>
        @endforeach
    </div>

    @if(!$isLocked)
        <button type="button" class="add-btn" onclick="addTournamentEntry()">Add Another Tournament</button>
    @endif
    

    <!-- Program Choices -->
    <h2>IV. Preferred Program/Course</h2>
    <div class="form-group">
        <label for="first_choice">First Choice</label>
        <input type="text" id="first_choice" name="first_choice" placeholder="e.g., Bachelor of Physical Education" value="{{ old('first_choice', $profile->first_choice ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <div class="form-group">
        <label for="second_choice">Second Choice</label>
        <input type="text" id="second_choice" name="second_choice" placeholder="e.g., BS Exercise and Sports Sciences" value="{{ old('second_choice', $profile->second_choice ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    <div class="form-group">
        <label for="third_choice">Third Choice</label>
        <input type="text" id="third_choice" name="third_choice" placeholder="e.g., BS Psychology" value="{{ old('third_choice', $profile->third_choice ?? '') }}" {{ $isLocked ? 'readonly' : '' }} required>
    </div>

    @if(!$isLocked)
        <p>Please keep in mind that the number of available slots is determined by the enrollment trend and the applicant's qualifications.</p>

        <!-- Certification Checkbox -->
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" id="certify">
                <span>I certify that the above information is true and correct.</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submit-btn" class="submit-btn">Submit Profile</button>
    @else
        <p style="color: gray;">This form has been submitted and is now locked.</p>
    @endif

<!-- Sidebar Toggle -->
<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-active');
        document.querySelector('.main-menu').classList.toggle('active');
    }
</script>

<<!-- Certification Enforcer (Always Runs When Form is Unlocked) -->
@if(!$isLocked)
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("athleteForm");
    const certifyCheckbox = document.getElementById("certify");
    const submitBtn = document.getElementById("submit-btn");

    if (certifyCheckbox && submitBtn) {
        // Enable or disable submit button based on checkbox
        function toggleSubmit() {
            submitBtn.disabled = !certifyCheckbox.checked;
        }

        certifyCheckbox.addEventListener("change", toggleSubmit);
        toggleSubmit(); // initialize state

        // Double check before submitting
        form.addEventListener("submit", function (e) {
            if (!certifyCheckbox.checked) {
                e.preventDefault();
                alert("You must certify the statement before submitting.");
            }
        });
    }
});
</script>
@endif

<!-- Add Tournament Entry Script -->
<script>
let tournamentIndex = {{ count($tournamentNames) }}; // continue from current count

function addTournamentEntry() {
    const container = document.getElementById('tournament-entries');

    const formRow = document.createElement('div');
    formRow.classList.add('form-row');

    formRow.innerHTML = `
        <div class="form-group">
            <label for="ntournament_${tournamentIndex}">Name of Tournament</label>
            <input type="text" name="ntournament[]" id="ntournament_${tournamentIndex}" required>
        </div>
        <div class="form-group">
            <label for="level_${tournamentIndex}">Level</label>
            <select name="level[]" id="level_${tournamentIndex}" required>
                <option value="">Select Level</option>
                <option value="International">International</option>
                <option value="National">National</option>
                <option value="Regional">Regional</option>
                <option value="Local">Local</option>
            </select>
        </div>
        <div class="form-group">
            <label for="year_${tournamentIndex}">Year</label>
            <input type="number" name="year[]" id="year_${tournamentIndex}" required>
        </div>
        <div class="wide-field">
            <label for="awards_${tournamentIndex}">Awards/Recognition received</label>
            <input type="text" name="awards[]" id="awards_${tournamentIndex}">
        </div>
    `;

    container.appendChild(formRow);
    tournamentIndex++;
}
</script>

<!-- Transferee Field Toggle Script -->
@if (!$isLocked)
<script>
document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById("isTransferee");
    const transfereeField = document.getElementById("transfereeField");

    function toggleTransfereeField() {
        if (checkbox.checked) {
            transfereeField.removeAttribute('readonly');
        } else {
            transfereeField.setAttribute('readonly', true);
            transfereeField.value = '';
        }
    }

    checkbox.addEventListener("change", toggleTransfereeField);
    toggleTransfereeField();
});
</script>
@endif

</body>
</html>
