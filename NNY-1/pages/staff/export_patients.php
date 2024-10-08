<?php
require_once "./patient_db_connect.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=patients.csv');

$output = fopen('php://output', 'w');

// Column headers
fputcsv($output, ['ID', 'First Name', 'Last Name', 'Phone Number', 'Email', 'Date of Birth', 'Height', 'Weight', 'Status']);

// Fetch patient data from the database
$sql = "SELECT id, fName, lName, contactNo, email, dob, height, weight, status FROM patient";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
