<?php
require_once "../../includes/connections.php"; 

<<<<<<< HEAD
// Define your data
$email = 'staff_vip_pr0@gmail.com';
=======
$email = 'johny.j@care.com';
>>>>>>> 3125bf7 (Change db on all file)
$fname = 'Johnny';
$lname = 'Johnny';
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
