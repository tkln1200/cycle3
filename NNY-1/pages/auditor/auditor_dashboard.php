
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Consultation Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/auditor.css">
</head>
<body>
<nav class="navbar">
        <div class="navbar-brand">Dashboard</div>
        <!-- <ul class="navbar-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="#">Patients</a></li>
            <li><a href="#">Doctors</a></li>
            <li><a href="#">Reports</a></li>
        </ul> -->
        <div class="navbar-icons">
            <a href="#" class="icon-bell"><img src="bell-icon.png" alt="Notifications"></a>
            <a href="#" class="icon-profile"><img src="profile-icon.png" alt="Profile"></a>
        </div>
    </nav>

<div class="dashboard">
    <div class="stats-container">
        <div class="stat">
            <h4>Appointments</h4>
            <p>20</p>
        </div>
        <div class="stat">
            <h4>Consult length</h4>
            <p>10 hrs</p>
        </div>
        <div class="stat">
            <h4>Patients</h4>
            <p>300</p>
        </div>
        <div class="stat">
            <h4>Doctors</h4>
            <p>100</p>
        </div>
    </div>
    <div class="container">
    <div class="filter-container">
        <h2>Filter by <span>Doctor's Name</span></h2>
        <button class="export-btn">Export</button>

        <div class="doctor-list">
            <!-- Doctor 1 -->
            <div class="doctor-card">
                <button class="doctor-name" onclick="toggleDetails(this)">Sagun Thapa</button>
            </div>

            <!-- Doctor 2 with details -->
            <div class="doctor-card">
                <button class="doctor-name" onclick="toggleDetails(this)">Malik Mbaye</button>
                <div class="doctor-details">
                    <table>
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Type of Case</th>
                                <th>Length of Consultation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12312321</td>
                                <td>PTSD</td>
                                <td>1.5 HRS</td>
                            </tr>
                            <tr>
                                <td>322523</td>
                                <td>OCD</td>
                                <td>2 HRS</td>
                            </tr>
                            <tr>
                                <td>30923</td>
                                <td>NCD</td>
                                <td>1 HR</td>
                            </tr>
                            <tr>
                                <td>5232314</td>
                                <td>DEPRESSION</td>
                                <td>1 HR</td>
                            </tr>
                            <tr>
                                <td>12412553</td>
                                <td>GAD</td>
                                <td>2 HRS</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Total = 5</p>
                </div>
            </div>

            <!-- Additional doctors -->
            <div class="doctor-card">
                <button class="doctor-name" onclick="toggleDetails(this)">Alexis Martinez</button>
            </div>
            <div class="doctor-card">
                <button class="doctor-name" onclick="toggleDetails(this)">Grace Wilkinson</button>
            </div>
        </div>
    </div>

    </div>
</div>

    <script src="../../assets/js/auditor.js"></script>
</body>
</html>
