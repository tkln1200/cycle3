<?php
session_start();
include_once '../../includes/connections.php';

// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure patientIds and groupName are set and valid
    if (!empty($_POST['patientIds']) && !empty($_POST['groupName'])) {
        $patient_ids = explode(',', $_POST['patientIds']);
        $group_name = mysqli_real_escape_string($conn, $_POST['groupName']);
        $space = (int)$_POST['availableSpace'];
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $sTime = mysqli_real_escape_string($conn, $_POST['sTime']);
        $eTime = mysqli_real_escape_string($conn, $_POST['eTime']);
        $therapist_id = $_SESSION['therapist_id'] ?? null;

        if (!$therapist_id) {
            die("Therapist not logged in or session expired.");
        }

        $occupied_space = count($patient_ids);
        $group_progression = 0;

        // Insert the group into the database using prepared statement
        $sql = "INSERT INTO groups (group_name, space, participants, location, date, sTime, eTime, therapist_id, occupied_space, group_progress)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            $participants = implode(",", $patient_ids);
            mysqli_stmt_bind_param($stmt, 'sissssssii', $group_name, $space, $participants, $location, $date, $sTime, $eTime, $therapist_id, $occupied_space, $group_progression);
            mysqli_stmt_execute($stmt);

            // Check if the insertion was successful
            $group_id = mysqli_insert_id($conn);
            if ($group_id) {
                echo "Group ID: $group_id<br>";
                echo "Patient IDs: " . implode(",", $patient_ids) . "<br>";

                // Insert into group_patients for each patient_id
                foreach ($patient_ids as $patient_id) {
                    $patient_id = (int)$patient_id;
                    $patient_sql = "INSERT INTO group_patients (group_id, patient_id) VALUES (?, ?)";
                    $patient_stmt = mysqli_prepare($conn, $patient_sql);
                    if ($patient_stmt) {
                        mysqli_stmt_bind_param($patient_stmt, 'ii', $group_id, $patient_id);
                        if (!mysqli_stmt_execute($patient_stmt)) {
                            echo "Failed to insert patient association for patient ID $patient_id: " . mysqli_error($conn) . "<br>";
                        }
                    } else {
                        echo "Failed to prepare statement for patient association: " . mysqli_error($conn);
                    }
                }

                echo "<script>
                        alert('Group created successfully!');
                        window.location.href = 'patient_list.php';
                      </script>";
                exit();
            } else {
                die("Failed to insert the group: " . mysqli_error($conn));
            }
        } else {
            die("Failed to prepare SQL statement: " . mysqli_error($conn));
        }
    } else {
        echo "<script>alert('Please ensure all required fields are filled.');</script>";
    }
} else {
    echo "Invalid request method.";
}
