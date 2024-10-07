<?php
session_start();
require_once "../../db/db_config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // Raw password entered by user

    // Query to fetch the hashed password from the database
    $sql = "SELECT patientId, password FROM patient_list WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the entered password with the stored hashed password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['patientId'] = $row['patientId'];
                header("Location: patient_dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No patient found with that email.";
        }

        $stmt->close();
    }
    $conn->close();
}
?>
