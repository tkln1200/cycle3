<?php
require_once "../../includes/connections.php"; 

$email = 'lauren.li@care.com';
$fname = 'Lauren';
$lname = 'Li';
$password = 'LaurenLi1';

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO therapist (email, fname, lname, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssss", $email, $fname, $lname, $hashed_password);

if ($stmt->execute()) {
    echo "Therapist record added successfully!";
} else {
    echo "Error adding record: " . $conn->error;
}

$stmt->close();
$conn->close();
