<?php
require_once "./login_connect.php"; // Replace with your actual database connection file

// Define your data
$therapistId = 5;
$email = 'zoe.glasson@gmail.com';
$title = 'Ms';
$fName = 'Zoe';
$lName = 'Glasson';
$dob = '1998-02-18';
$gender = 'Female';
$contactNo = '0412345678';
$streetAddress = '122 Main Rd';
$postCode = '5000';
$height = 156.00;
$weight = 60.00;
$startDate = '2024-01-23';
$endDate = '0000-00-00';
$diagnosis = 'GAD';
$status = 'Active';
$profile = NULL;
$password = 'ZoeGlasson1';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

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
    echo "Patient record added successfully!";
} else {
    echo "Error adding record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

