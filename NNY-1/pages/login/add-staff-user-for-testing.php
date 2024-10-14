<?php
require_once "../../includes/connections.php"; 

$email = 'johny.j@care.com';
$fname = 'Johnny';
$lname = 'Jullian';
$password = '123456';

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO staff (email, fname, lname, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssss", $email, $fname, $lname, $hashed_password);

if ($stmt->execute()) {
    echo "Staff record added successfully!";
} else {
    echo "Error adding record: " . $conn->error;
}

$stmt->close();
$conn->close();
