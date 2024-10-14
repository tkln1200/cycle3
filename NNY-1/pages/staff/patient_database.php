<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Database</title>
    <link rel="stylesheet" href="../../styles/staff_page.css"> <!-- Link to your CSS file -->
</head>

<body>

    <header>
        <?php
        session_start();
        include_once("../navigation/straff_nav.php");
        require_once "./patient_db_connect.php";

        $sql = "SELECT id, fName, lName, contactNo, email, dob, height, weight, status FROM patient";
        $result = $conn->query($sql);

        $patientCount = 0;
        $patients = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $patients[] = $row;
            }
            $patientCount = $result->num_rows;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['therapistId'])) {
            // Collect form data
            $therapistId = $_POST['therapistId'];
            $title = $_POST['title'];
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $contactNo = $_POST['contactNo'];
            $email = $_POST['email'];
            $streetAddress = $_POST['streetAddress'];
            $postCode = $_POST['postCode'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $diagnosis = $_POST['diagnosis'];
            $status = $_POST['status'];
            // $password = $_POST['password'];

            // Hash the password
            $hashed_password = password_hash('FlytotheSky96', PASSWORD_BCRYPT); //Default password FlytotheSky96

            // Insert data into the Patient table
            $sql = "INSERT INTO patient (therapistId, title, fName, lName, dob, gender, contactNo, email, streetAddress, postCode, height, weight, startDate, endDate, diagnosis, status, password)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Error preparing the statement: " . $conn->error);
            }

            // Bind parameters
            $stmt->bind_param("isssssssssdssssss", $therapistId, $title, $fName, $lName, $dob, $gender, $contactNo, $email, $streetAddress, $postCode, $height, $weight, $startDate, $endDate, $diagnosis, $status, $hashed_password);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Patient added successfully!'); window.location.href = 'patient_database.php';</script>";
            } else {
                echo "<script>alert('Error adding patient: " . $conn->error . "');</script>";
            }

            // Close the statement and connection
            $stmt->close();
        }

        $conn->close();

        ?>
    </header>

    <main>
        <!-- Main Content -->
        <div class="main-container">
            <div class="patient-header">
                <div class="patient-count">
                    <h3>Patients: </h3>
                    <span class="patient-count-number"><?php echo $patientCount; ?></span>
                </div>
            </div>

            <!-- Controls and Search Bar in the Same Line -->
            <div class="controls-and-search">
                <div class="controls">
                    <button class="btn create-btn" id="openModalBtn">Add Patient</button>
                    <button class="btn export-btn" onclick="document.getElementById('exportForm').submit();">Export</button>
                </div>
                <form id="exportForm" action="export_patients.php" method="POST" style="display: none;"></form>
                <div class="search-bar">
                    <input type="text" placeholder="Search..." id="search-input">
                </div>
            </div>

            <div id="createPatientModal" class="modal">
                <div class="new-modal-content">
                    <span class="close">&times;</span>
                    <h2>Create Patient Credentials</h2>
                    <form id="createPatientForm" method="POST" action="patient_database.php" enctype="multipart/form-data">
                        <label for="therapistId">Therapist ID:</label>
                        <input type="number" id="therapistId" name="therapistId" required>

                        <label for="title">Title:</label>
                        <!-- <input type="text" id="title" name="title" maxlength="10" required> -->
                        <select id="title" name="title" required>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                            <option value="Other">Other</option>
                        </select>

                        <label for="fName">First Name:</label>
                        <input type="text" id="fName" name="fName" maxlength="50" required>

                        <label for="lName">Last Name:</label>
                        <input type="text" id="lName" name="lName" maxlength="50" required>

                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" required>

                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>

                        <label for="contactNo">Contact Number:</label>
                        <input type="text" id="contactNo" name="contactNo" maxlength="15" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="streetAddress">Street Address:</label>
                        <input type="text" id="streetAddress" name="streetAddress" maxlength="255" required>

                        <label for="postCode">Postal Code:</label>
                        <input type="text" id="postCode" name="postCode" maxlength="10" required>

                        <label for="height">Height (cm):</label>
                        <input type="number" id="height" name="height" step="0.01" required>

                        <label for="weight">Weight (kg):</label>
                        <input type="number" id="weight" name="weight" step="0.01" required>

                        <label for="startDate">Start Date of Treatment:</label>
                        <input type="date" id="startDate" name="startDate" required>

                        <label for="endDate">End Date of Treatment:</label>
                        <input type="date" id="endDate" name="endDate">

                        <label for="diagnosis">Diagnosis:</label>
                        <textarea id="diagnosis" name="diagnosis" rows="4"></textarea>

                        <label for="status">Status:</label>
                        <select id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <!-- <label for="profile">Profile Image:</label>
                        <input type="file" id="profile" name="profile" accept="image/*"> -->
                        <!-- <label for="password">Temporary Password:</label>
                        <input type="text" id="password" name="password" required> -->

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Patient Table -->
            <div class="patient-list-container">
                <table class="patient-table">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="patientTableBody">
                        <!-- Rows will be added here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <div class="pagination" id="paginationControls">
                <!-- Pagination buttons will be generated by JavaScript -->
            </div>
    </main>

    <footer>

    </footer>
    <script>
        // Pass the PHP data to JavaScript
        const patients = <?php echo json_encode($patients); ?>;
    </script>
    <script src="../../components/staff/staff.js"></script>

</body>

</html>