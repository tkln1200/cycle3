<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Database</title>
    <link rel="stylesheet" href="../../assets/css/style.patient_dashboard.css"> <!-- Add your own CSS file here -->
</head>
<body>

<!-- Navigation Bar -->
<header>
    <nav class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="patients.php" class="active">Patients</a></li>
            <li><a href="doctors.php">Doctors</a></li>
        </ul>
        <div class="nav-right">
            <div class="profile">
                <!-- Profile Picture & Notifications -->
                <img src="../../assets/images/profile.png" alt="Profile Picture" class="profile-pic">
                <i class="bell-icon"></i>
            </div>
        </div>
    </nav>
</header>

<div class="main-container">
    <!-- Patient Summary Card -->
    <div class="summary-card">
        <div class="card-content">
            <i class="patient-icon"></i>
            <div class="card-text">
                <span>Patients</span>
                <h2>300</h2>
            </div>
        </div>
    </div>

    <!-- Patient List Section -->
    <div class="patient-list-container">
        <h2>All Patients</h2>

        <!-- Search and Action Buttons -->
        <div class="actions">
            <button class="btn create-btn">Create</button>
            <button class="btn export-btn">Export</button>
            <div class="search-bar">
                <input type="text" placeholder="Search..." id="search-input">
            </div>
        </div>

        <!-- Patient Table -->
        <table class="patient-table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Nationality</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $host = "localhost";
                $username = "root";
                $password = "";
                $dbname = "healthcare";

                // Create a connection
                $conn = new mysqli($host, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to get patients data
                $sql = "SELECT fName, lName, contactNo, email, age, height, weight, nationality FROM patients";
                $result = $conn->query($sql);

                // Check if records exist
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["fName"] . " " . $row["lName"] . "</td>";
                        echo "<td>" . $row["contactNo"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["height"] . "</td>";
                        echo "<td>" . $row["weight"] . "</td>";
                        echo "<td>" . $row["nationality"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No patients found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-container">
        <div class="calendar-header">
            <h3>March</h3>
            <div class="calendar-nav">
                <button class="prev-month">←</button>
                <button class="next-month">→</button>
            </div>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
            </thead>
            <tbody>
                <!-- Calendar days (dynamically generated or hardcoded for now) -->
                <tr>
                    <td></td><td></td><td></td><td></td><td>1</td><td>2</td><td>3</td>
                </tr>
                <tr>
                    <td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
                </tr>
                <tr>
                    <td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td>
                </tr>
                <tr>
                    <td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td>
                </tr>
                <tr>
                    <td class="selected-day">25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
