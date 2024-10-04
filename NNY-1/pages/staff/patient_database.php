<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Patient Database</title>
    <link rel="stylesheet" href="../../styles/staff_page.css"> <!-- Link to your CSS file -->
</head>
<body>

<header>
    <?php
        include_once("../navigation/straff_nav.php");
        require_once "patient_db_connect.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['therapistId']) && isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['dob'])) {
            // Function to handle image upload
            function uploadProfileImage($file) {
                // Check if the file was uploaded without errors
                if (isset($file) && $file['error'] == 0) {
                    $fileTmpPath = $file['tmp_name'];
                    $fileType = mime_content_type($fileTmpPath);
                    
                    // Check if it's an image
                    if (strpos($fileType, 'image') === false) {
                        die("Error: The uploaded file is not an image.");
                    }
                    
                    // Read file content into a blob (binary large object)
                    $imageBlob = file_get_contents($fileTmpPath);
                    
                    return $imageBlob;
                }
                
                return null;
            }

            // Upload the profile image
            $profileImage = uploadProfileImage($_FILES['profile']);

            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO Patient (therapistId, title, fName, lName, dob, gender, contactNo, email, streetAddress, postCode, height, weight, startDate, endDate, diagnosis, status, profile, password)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die('Prepare failed: ' . $conn->error);
            }

            // Hash the password
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Bind parameters (18 placeholders and password)
            // For NULL values (like endDate and profile), pass them directly
            $stmt->bind_param(
                "isssssssssdsssssb",
                $_POST['therapistId'],          // i: therapistId
                $_POST['title'],                // s: title
                $_POST['fName'],                // s: fName
                $_POST['lName'],                // s: lName
                $_POST['dob'],                  // s: dob
                $_POST['gender'],               // s: gender
                $_POST['contactNo'],            // s: contactNo
                $_POST['email'],                // s: email
                $_POST['streetAddress'],        // s: streetAddress
                $_POST['postCode'],             // s: postCode
                $_POST['height'],               // d: height
                $_POST['weight'],               // d: weight
                $_POST['startDate'],            // s: startDate
                $_POST['endDate'],              // s: endDate (can be NULL)
                $_POST['diagnosis'],            // s: diagnosis
                $_POST['status'],               // s: status
                $profileImage,                  // b: profile image as blob (can be NULL)
                $hashedPassword                 // s: hashed password
            );

            // Execute the statement
            if ($stmt->execute()) {
                echo "Patient added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        }
        // } else {
        //     // Handle the case where required fields are not set or the request is not POST
        //     echo "Invalid request. Please ensure all required fields are filled in.";
        // }
    ?>
</header>

<main>
<!-- Main Content -->
<div class="main-container">
    <div class="patient-header">
        <div class="patient-count">
            <h3>Patients</h3>
            <span class="patient-count-number">300</span>
        </div>
    </div>

    <!-- Controls and Search Bar in the Same Line -->
    <div class="controls-and-search">
        <div class="controls">
            <button class="btn create-btn" id="openModalBtn">Add Patient</button>
            <button class="btn export-btn">Export</button>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search..." id="search-input">
        </div>
    </div>

    <div id="createPatientModal" class="modal">
        <div class="new-modal-content">
            <span class="close">&times;</span>
            <h2>Create Patient Credentials</h2>
            <form id="createPatientForm" method="POST" action="">
                <label for="therapistId">Therapist ID:</label>
                <input type="number" id="therapistId" name="therapistId" required>

                <label for="title">Title (Mr./Mrs.):</label>
                <input type="text" id="title" name="title" maxlength="10" required>

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
                <label for="profile">Profile Image:</label>
                <input type="file" id="profile" name="profile" accept="image/*">
                <label for="password">Temporary Password:</label>
                <input type="text" id="password" name="password" required>

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
                    <th>Nationality</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jane Cooper</td>
                    <td>048145840</td>
                    <td>janecooper@gmail.com</td>
                    <td>28</td>
                    <td>5'6"</td>
                    <td>90 kg</td>
                    <td>Australian</td>
                </tr>
                <tr>
                    <td>Amara Johnson</td>
                    <td>048145840</td>
                    <td>amara1994@gmail.com</td>
                    <td>32</td>
                    <td>5'8"</td>
                    <td>65 kg</td>
                    <td>American</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#" class="page-link">&laquo;</a>
        <a href="#" class="page-link active">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">4</a>
        <a href="#" class="page-link">&raquo;</a>
    </div>
</div>
</main>

<footer>

</footer>
<script src="../../components/staff/staff.js"></script>

</body>

</html>
