<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/GradesStyle.css') }}">
    <title>ISKOLETA+</title>
</head>
<body>
    <!-- sidebar -->
    <div class="nav-title">Academic Grades</div>
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
                    <a href="{{ route('grades') }}">
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

    <div class="grade-form">
        <h2>Academic Grade Evaluation</h2>

        <form id="gradesForm" method="POST" action="{{ route('grades.submit') }}" enctype="multipart/form-data">
            @csrf
            <div id="grade-section">
                <div class="grade-row">
                    <div class="form-group">
                        <label for="subject[]">Subject</label>
                        <input type="text" name="subject[]" required>
                    </div>

                    <div class="form-group">
                        <label for="grade[]">Grade</label>
                        <select name="grade[]" class="grade-select" required>
                            <option value="" disabled selected>Select Grade</option>
                            @foreach(['1.00','1.25','1.50','1.75','2.00','2.25','2.50','2.75','3.00','4.00','5.00','INC','Dropped','Withdraw'] as $grade)
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" class="add-btn" onclick="addGradeRow()">Add Another Subject</button>

            <div class="form-group">
                <label for="proof_overall">Upload Combined Grade Proof</label>
                <input type="file" id="proof_overall" name="proof_overall" accept="image/*,application/pdf" required>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn" disabled>Submit</button>

            <div class="form-group">
                <p><strong>Total Average:</strong> <span id="total-average">0</span></p>
                <p><strong>Status:</strong> <span id="grade-status">0</span></p>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" id="certify" required>
                    <span>I certify that the above statement is true and correct.</span>
                </label>
            </div>
        </form>
    </div>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
        }

        function addGradeRow() {
            const section = document.getElementById("grade-section");
            const firstRow = section.querySelector(".grade-row");
            const clone = firstRow.cloneNode(true);

            clone.querySelectorAll("input, select").forEach(el => {
                if (el.type !== "file") el.value = "";
            });

            section.appendChild(clone);
        }

        function finalizeGrades() {
            const proofUploaded = document.getElementById('proof_overall').value;
            const grades = Array.from(document.querySelectorAll('.grade-select')).map(sel => sel.value.trim().toUpperCase());

            const avgEl = document.getElementById('total-average');
            const statusEl = document.getElementById('grade-status');

            if (!proofUploaded) {
                alert("Please upload a proof of grades first.");
                return;
            }

            let sum = 0, count = 0, atRisk = false;

            grades.forEach(g => {
                if (["INC", "DROPPED", "WITHDRAW", "4.00", "5.00"].includes(g)) {
                    atRisk = true;
                }
                const num = parseFloat(g);
                if (!isNaN(num) && num <= 3.00 && num >= 1.00) {
                    sum += num;
                    count++;
                }
            });

            const average = count > 0 ? (sum / count).toFixed(2) : "-";
            avgEl.textContent = average;

            if (average === "-") {
                statusEl.textContent = "Incomplete Data";
                statusEl.style.color = "#fff";
            } else {
                statusEl.textContent = atRisk ? "At Risk of Disqualification" : "Qualified";
                statusEl.style.color = atRisk ? "orange" : "lightgreen";
            }

            document.querySelectorAll('#grade-section input, #grade-section select').forEach(el => el.disabled = true);
            document.getElementById('proof_overall').disabled = true;
            document.querySelector('.submit-btn').disabled = true;
            document.querySelector('.submit-btn').style.opacity = '0.6';
            document.querySelector('.submit-btn').style.cursor = 'not-allowed';
            document.querySelector('.add-btn').disabled = true;
            document.querySelector('.add-btn').style.opacity = '0.6';
            document.querySelector('.add-btn').style.cursor = 'not-allowed';
        }
    </script>
    <script>
    // Enable/disable submit button based on checkbox
    document.getElementById("certify").addEventListener("change", function () {
        const submitBtn = document.getElementById("submitBtn");
        submitBtn.disabled = !this.checked;
        submitBtn.style.opacity = this.checked ? '1' : '0.6';
        submitBtn.style.cursor = this.checked ? 'pointer' : 'not-allowed';
    });
</script>
</body>
</html>