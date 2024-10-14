<?php
session_start();
require_once '../../includes/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decode the selected patients JSON string
    $selected_patients = json_decode($_POST['selected_patients'], true);
    
    // Retrieve other POST data
    $group_name = $_POST['groupName'];
    $space = $_POST['availableSpace'];

    $patient_ids = explode(',',$_POST['patientIds']);
    // Sanitize each patient ID and prepare it for the SQL query
    $patient_ids = array_map('intval', $patient_ids);

    // Create a comma-separated list of patient IDs for the IN clause
    $patient_ids_list = implode(',', $patient_ids);
    echo $patient_ids_list;
    $query = "SELECT fName FROM patient WHERE id IN ($patient_ids_list)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $patient_names = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $patient_names[] = $row['name'];
        }
        // Now $patient_names contains the names of the selected patients
        print_r($patient_names); // Output or further process the names as needed
    } else {
        echo "Error: " . mysqli_error($db);
    }
    $patient_names_string = implode(', ', $patient_names);
    $location = $_POST['location'];
    $date = $_POST['date'];
    $sTime = $_POST['sTime'];
    $eTime = $_POST['eTime'];
    $therapist_id = $_SESSION['therapist_id'];
    $occupied_space = 0;
    $group_progression = 0;
    $pID = $_POST['patientIds'];

    $sql = "INSERT INTO groups (group_name, space, participants, location, date, sTime, eTime, therapist_id, occupied_space, group_progress) VALUES ('$group_name', '$space', '$pID', '$location', '$date', '$sTime', '$eTime', '$therapist_id', '$occupied_space', '$group_progression')";
    
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
