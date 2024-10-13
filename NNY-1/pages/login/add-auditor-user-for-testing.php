<?php
require_once "./login_connect.php"; // Replace with your actual database connection file

// Define your data
$email = 'amanda.a@care.com';
$fname = 'Amanda';
$lname = 'Auditor';
$password = '123456';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare the SQL statement
$sql = "INSERT INTO auditor (email, fname, lname, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("ssss", $email, $fname, $lname, $hashed_password);

if ($stmt->execute()) {
    echo "Auditor record added successfully!";
} else {
    echo "Error adding record: " . $conn->error;
}

$stmt->close();
$conn->close();
