<!-- Thea edit mo na lang to kung may nagawa ka na -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="Logo.png" type="image/png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <link rel="stylesheet" href="GradeStyle.css">
    <title>ISKOLETA+</title>
</head>
<body>
    <div class="nav-title">Grades</div>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="container">
        <nav class="main-menu">
                <ul>
                    <li class="home-subnav">
                        <a href="SDPOHome.html">
                            <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                            <span class="nav-text">
                            Dashboard
                            </span>
                        </a> 
                    </li>
                    <li class="student-subnav">
                        <a href="#">
                            <i class="fa-solid fa-person-walking" style="color: #ffffff;"></i>
                            <span class="nav-text">
                                Student-Athlete
                            </span>
                        </a>          
                    </li>
                     <li class="grades-subnav">
                        <a href="GradesView.html">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                            <span class="nav-text">
                                Grades
                            </span>
                        </a>
                    </li>
                    <li class="coach-subnav">
                        <a href="RegisteredCoach.html">
                        <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i>
                            <span class="nav-text">
                                Coaches
                            </span>
                        </a>
                    </li>
                    <li class="profile-subnav">
                        <a href="ProfileSDPO.html">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                            <span class="nav-text">
                                Profile
                            </span>
                        </a>
                    </li>
                <li class="logout">
                    <a href="Home.html">
                            <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                            <span class="nav-text">
                                Logout
                            </span>
                        </a>
                    </li>  
                </ul>
            </nav>
        </div>

        <div class="search-wrapper">
            <input type="text" id="coachSearch" placeholder="🔍 Search students by name, sport, or status">
        </div>

        <div class="grades-table-container">
           <div class="grades-header">
                <h2>Grades of Student-Athlete</h2>
            </div>

            <table class="grades-table">
                <thead>
                <tr>
                    <th>NAME</th>
                    <th>SPORT</th>
                    <th>COACH</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($grades as $grade): ?>
                    <tr>
                    <td><?= htmlspecialchars($grade['name']) ?></td>
                    <td><?= htmlspecialchars($grade['sport']) ?></td>
                    <td><?= htmlspecialchars($grade['coach']) ?></td>
                    <td><?= htmlspecialchars($grade['status']) ?></td>
                    <td><a href="ViewGrades.html" class="action-view">View</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
         <script>
            //sidebar script
            function toggleSidebar() {
            document.body.classList.toggle('sidebar-active');
            document.querySelector('.main-menu').classList.toggle('active');
            }

            //search bar script
            document.getElementById("gradeSearch").addEventListener("input", function () {
                const keyword = this.value.toLowerCase();
                const rows = document.querySelectorAll(".grades-table tbody tr");

                rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
                });
            });
        </script>
    </body>
</html>