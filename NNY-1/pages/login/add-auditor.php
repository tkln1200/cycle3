<?php
require_once "../../includes/connections.php"; 

$email = 'auditor_vip_pr0@gmail.com';
$fname = 'Johnny';
$lname = 'Johnny';
$password = '123456';

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO auditor (email, fname, lname, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssss", $email, $fname, $lname, $hashed_password);

if ($stmt->execute()) {
    echo "Auditor record added successfully!";
} else {
    echo "Error adding record: " . $conn->error;
}

$stmt->close();
$conn->close();
