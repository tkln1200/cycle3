<?php
session_start();
include_once '../../includes/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decode the selected patients JSON string
    $selected_patients = json_decode($_POST['selected_patients'], true);
    
    // Retrieve other POST data
    $group_name = $_POST['group_name'];
    $space = $_POST['space'];
    $participants = $_POST['participants'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $sTime = $_POST['sTime'];
    $eTime = $_POST['eTime'];
    $therapist_id = $_SESSION['therapist_id'];
    $occupied_space = $_POST['filled_space'];
    $group_progression = 0;

    $sql = "INSERT INTO groups (group_name, space, participants, location, date, sTime, eTime, therapist_id, occupied_space, group_progress) VALUES ('$group_name', '$space', '$participants', '$location', '$date', '$sTime', '$eTime', '$therapist_id', '$occupied_space', '$group_progression')";
    
    if (mysqli_query($conn, $sql)) {
        $group_id = mysqli_insert_id($conn);

        foreach ($selected_patients as $patient_id) {
            $patient_sql = "INSERT INTO group_patients (group_id, patient_id) VALUES ('$group_id', '$patient_id')";
            if (!mysqli_query($conn, $patient_sql)) {
                die("Failed to insert patient association: " . mysqli_error($conn));
            }
        }

        header("Location:patient_list.php");
    } else {
        die("Failed to insert the data in groups table: " . mysqli_error($conn));
    }
}
?>
