<?php
define("DB_HOST", "localhost");
define("DB_NAME", "care_db"); 
define("DB_USER", "root");
define("DB_PASS", "root");

// Create connection
$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging error: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}

?>
