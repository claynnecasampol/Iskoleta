<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ISKOLETA+ — Edit Profile</title>
  <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/SPUPStyle.css') }}" rel="stylesheet">
</head>
<body>
  <!-- Sidebar -->
  <div class="nav-title">Athletic Profile</div>
  <button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
  </button>
  <nav class="main-menu">
    <ul>
      <li><a href="{{ url('/SAHome') }}"><i class="fa-solid fa-house"></i><span class="nav-text">Dashboard</span></a></li>
      <li><a href="{{ url('/SAProfile') }}"><i class="fa-solid fa-person-walking"></i><span class="nav-text">Athletic Profile</span></a></li>
      <li><a href="{{ url('/Grades') }}"><i class="fa-solid fa-star"></i><span class="nav-text">Academic Grades</span></a></li>
      <li><a href="{{ route('personal.profile') }}"><i class="fa-solid fa-user"></i><span class="nav-text">Profile</span></a></li>
      <li class="logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout-button">
            <i class="fa-solid fa-right-from-bracket"></i><span class="nav-text">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </nav>

  <!-- Edit Form -->
  <div class="container">
    <h2>Edit Athlete Profile</h2>
    <form action="{{ route('personal.profile.update') }}" method="POST">
      @csrf

      <!-- Name Row -->
      <div class="form-grid">
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input id="firstname" name="firstname" type="text"
            value="{{ old('firstname', $athlete->first_name) }}" required>
        </div>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input id="lastname" name="lastname" type="text"
            value="{{ old('lastname', $athlete->last_name) }}" required>
        </div>
      </div>

      <!-- Email & Contact Row -->
      <div class="form-grid">
        <div class="form-group">
          <label for="schoolmail">School Email</label>
          <input id="schoolmail" name="schoolmail" type="email" readonly
            value="{{ old('schoolmail', $athlete->school_email) }}">
        </div>
        <div class="form-group">
          <label for="contact">Contact Number</label>
          <input id="contact" name="contact" type="number"
            value="{{ old('contact', $athlete->contact) }}" required>
        </div>
      </div>

      <!-- Course, Year & Age Row -->
      <div class="form-grid">
        <div class="form-group">
          <label for="course">Course</label>
          <input id="course" name="course" type="text"
            value="{{ old('course', $athlete->course) }}" required>
        </div>
        <div class="form-group">
          <label for="year_level">Year Level</label>
          <select id="year_level" name="year_level" required>
            <option value="">Select</option>
            @foreach(['1st Year','2nd Year','3rd Year','4th Year','5th Year'] as $lvl)
              <option value="{{ $lvl }}" {{ old('year_level', $athlete->year_level) == $lvl ? 'selected' : '' }}>
                {{ $lvl }} Year
              </option>
            @endforeach
          </select>
          </select>
        </div>
        <div class="form-group">
          <label for="age">Age</label>
          <input id="age" name="age" type="number" readonly
            value="{{ old('age', $athlete->age) }}">
        </div>
      </div>

      <!-- Password Toggle -->
      <div class="form-group">
        <button type="button" id="togglePassword" class="btn-gold">Change Password</button>
      </div>
      <div id="passwordFields" style="display:none;">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input id="current_password" name="current_password" type="password">
        </div>
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input id="new_password" name="new_password" type="password">
        </div>
      </div>

      <!-- Save -->
      <div class="button-save">
        <button type="submit" class="btn-gold">Save Changes</button>
      </div>
    </form>
  </div>

  <script>
    function toggleSidebar() {
      document.body.classList.toggle('sidebar-active');
      document.querySelector('.main-menu').classList.toggle('active');
    }
    document.getElementById('togglePassword').addEventListener('click', function() {
      const p = document.getElementById('passwordFields');
      const show = p.style.display !== 'block';
      p.style.display = show ? 'block' : 'none';
      this.textContent = show ? 'Cancel' : 'Change Password';
    });
  </script>
</body>
</html>
