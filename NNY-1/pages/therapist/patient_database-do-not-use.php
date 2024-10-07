<?php
//require_once "../../db/db_config.php"; // Include your database connection file
define("DB_HOST", "localhost");
define("DB_NAME", "cheng123");
define("DB_USER", "root");
define("DB_PASS", "");
 
$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
if (!$conn) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging error: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}

$sql_check = "SHOW COLUMNS FROM `patient_list` LIKE 'password'";
$result_check = mysqli_query($conn, $sql_check);
if (mysqli_num_rows($result_check) == 0) {
    // If the password column doesn't exist, alter the table to add the password column
    $sql_alter = "ALTER TABLE patient_list ADD COLUMN password VARCHAR(255) NOT NULL";
    if (mysqli_query($conn, $sql_alter)) {
        echo "Password column added successfully.";
    } else {
        echo "Error adding password column: " . mysqli_error($conn);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fName = $_POST['fName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $streetAddress = $_POST['streetAddress'];
    $height = $_POST['height'];
    //$weight = $_POST['weight'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $diagnosis = $_POST['diagnosis'];
    $password = $_POST['password']; // Raw password entered

    // Hash the password using the password_hash() function
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create SQL query to insert patient info into the database
    $sql = "INSERT INTO patient_list (fName, age, gender, contactNo, email, streetAddress, height, startDate, endDate, diagnosis)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the form data to the SQL statement
        $stmt->bind_param("sissssssss", $fName, $age, $gender, $contactNo, $email, $streetAddress, $height, $startDate, $endDate, $diagnosis);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // If insertion is successful, display a success message
            echo "<script>alert('Patient information added successfully!');</script>";
        } else {
            // If insertion fails, display an error message
            echo "<script>alert('Error adding patient information: " . $conn->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // If preparation fails, display an error message
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Database</title>
    <link rel="stylesheet" href="../../styles/patient_dashboard.css"> <!-- Link to your CSS file -->
</head>
<body>

<!-- Navigation -->
<header>
    <nav class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="patients.php" class="active">Patients</a></li>
            <li><a href="doctors.php">Doctors</a></li>
        </ul>
        <div class="nav-right">
            <div class="profile">
                <img src="../../assets/images/profile.png" alt="Profile Picture" class="profile-pic">
                <i class="bell-icon"></i>
            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<div class="main-container">
    <div class="patient-header">
        <div class="patient-count">
            <h2>All Patients</h2>
        </div>
        <div class="actions">
            <button class="btn create-btn" id="createBtn">Create</button>
            <button class="btn export-btn">Export</button>
        </div>
    </div>

    <!-- Search and Patient Table -->
    <div class="patient-list-container">
        <div class="search-bar">
            <input type="text" placeholder="Search..." id="search-input">
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
                <!-- Patient Data from Database -->
                <!-- Add your PHP/SQL code here to fetch and display patients -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Creating Patient -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Create New Patient</h2>
        <form action="patient_database.php" method="POST">
            
            <label for="fName">First Name:</label>
            <input type="text" id="fName" name="fName" required><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br>

            <label for="contactNo">Contact Number:</label>
            <input type="text" id="contactNo" name="contactNo" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="streetAddress">Street Address:</label>
            <input type="text" id="streetAddress" name="streetAddress" required><br>

            <label for="height">Height:</label>
            <input type="text" id="height" name="height" required><br>

            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" required><br>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required><br>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required><br>

            <label for="diagnosis">Diagnosis:</label>
            <textarea id="diagnosis" name="diagnosis" required></textarea><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<!-- JavaScript for handling modal -->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("createBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
