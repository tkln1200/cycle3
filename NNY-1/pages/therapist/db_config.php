<?php
define("DB_HOST", "localhost");
define("DB_NAME", "cheng123");
define("DB_USER", "root");
define("DB_PASS", "");

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    echo "Error: Unable to connect to the database.<br>";
    exit;
}

// Check if the password column exists
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
?>
