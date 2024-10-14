<?php

session_start();
include_once '../../includes/connections.php';
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $patient_id = $_GET['id'];
    $therapist_id=$_SESSION['therapist_id'];

    $notes = $_POST['patient_notes'];
    $sql_notes_insert = "INSERT INTO notes(patient_id,therapist_id,notes) VALUES ('$patient_id','$therapist_id','$notes')";
    $sql_notes_update = "UPDATE notes SET notes = '$notes' WHERE patient_id = '$patient_id'";
    $sql_search_patient  = "SELECT * FROM notes where patient_id = $patient_id";

    
    $sql_search_obj =  mysqli_query($conn,$sql_search_patient) Or die("Failed to query " . mysqli_error($conn));
    
    if(mysqli_num_rows($sql_search_obj)>0)
    {


        if(!mysqli_query($conn,$sql_notes_update))
        {
            die("Failed to query " . mysqli_error($conn));
        }
        else
        {
            header("Location: patient_profile.php?id=" . urlencode($patient_id));
        }
    }
    else
    {
        if(!mysqli_query($conn,$sql_notes_insert))
        {
            die("Failed to query " . mysqli_error($conn));
        }
        else
        {
            header("Location: patient_profile.php?id=" . urlencode($patient_id));
        }
    }

}


?>