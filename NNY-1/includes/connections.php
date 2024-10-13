<?php

define("DB_HOST", "localhost");
define("DB_NAME", "care_db");
define("DB_USER", "root");
define("DB_PASS", "root");

// Create connection
$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn)
{
    echo "Not Connected to the server";
}
if(!mysqli_select_db($conn,'care_db'))
{
    echo "database is not selected";
}
// if($conn)
// {
//     echo"hi";
// }
?>