<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Calendar</title>
    <link rel="stylesheet" href="../styles/patient-calendar.css">
</head>
<body>
    <div class="navbar">
        <a href="therapist-dashboard.html">Dashboard</a>
        <a href="#calendar">Patient Calendar</a>
        <a href="#logout">Log Out</a>
    </div>
    <div class="container">
        <div class="appointments">
            <h2>Upcoming Appointments</h2>
            <div class="appointment-dates">
                <div class="date">24</div>
                <div class="date">25</div>
                <div class="date">26</div>
                <div class="date">27</div>
                <div class="date">28</div>
                <div class="date selected">29</div>
                <div class="date">30</div>
                <div class="date">01</div>
                <div class="date">02</div>
                <div class="date">03</div>
                <div class="date">04</div>
                <div class="date">05</div>
                <div class="date">06</div>
                <div class="date">07</div>
                <div class="date">08</div>
                <div class="date">09</div>
                <div class="date">10</div>
                <div class="date">11</div>
                <button class="next-btn">&#10095;</button>
            </div>
        </div>
        <div class="schedule-list">
            <h2>Schedule List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Appoint for</th>
                        <th>Name</th>
                        <th>Date and Time</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Therapy</td>
                        <td>Minho</td>
                        <td>29th Sep, 10:00 AM</td>
                        <td>Individual</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="patients-overview">
            <h2>Patients Overview</h2>
        </div>
        <div class="groups-overview">
            <h2>Groups</h2>
        </div>
    </div>
</body>
</html>
