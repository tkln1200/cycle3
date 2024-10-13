<?php
    include_once '../../includes/connections.php';
    session_start();

    $patient_id = $_GET['id'];
    $sql_patient  = "SELECT * FROM patient where id = $patient_id";
    // $sql_patient_details  = "SELECT * FROM patient_details where patient_id = $patient_id";   
    $sql_patient_notes  = "SELECT * FROM notes where patient_id = $patient_id";
    $sql_journals = "SELECT * FROM journal where patientId = $patient_id";

    $sql_patient_obj = mysqli_query($conn,$sql_patient) Or die("Failed to query " . mysqli_error($conn));
    // $sql_patient_details_obj = mysqli_query($conn,$sql_patient_details) Or die("Failed to query " . mysqli_error($conn));
    $sql_patient_notes_obj = mysqli_query($conn,$sql_patient_notes) Or die("Failed to query " . mysqli_error($conn));
    $sql_patient_journal_obj = mysqli_query($conn,$sql_journals) Or die("Failed to query " . mysqli_error($conn));

    $count_patients = mysqli_num_rows($sql_patient_obj);
    if ($count_patients>0) {
       $patient = mysqli_fetch_assoc($sql_patient_obj);
      //  $patient_details = mysqli_fetch_assoc($sql_patient_details_obj);
       $patient_notes =  mysqli_fetch_assoc($sql_patient_notes_obj);
       if(isset($patient_notes['notes']))
       {
          $notes_array = explode('.', $patient_notes['notes']);
       }

    }
    

    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient Note</title>
    <link rel="stylesheet" href="../../assets/css/patient-note.css" />
    <link rel="stylesheet" href="../../assets/css/therapist.css" />
  </head>
  <body>
  <header>
    <?php include_once ("../navigation/therapist_nav.php")
    ?> 
    </header>
    <div class="container">
      <!-- Patient Profile Section -->
      <div class="patient-profile">
        <div class="profile-header">
          <img
            src="../../assets/images/patient.png"
            alt="Zoe Ashford"
            class="profile-photo"
          />
          <div class="patient-info">
          <h2><?php echo $patient['fName'] ." " .  $patient['lName'];?></h2>
                    <p class="patient-details">Date of Birth: <?php echo isset($patient['dob']) ? htmlspecialchars($patient['dob']) : 'Not available'; ?></p>
                    <p class="patient-details">Gender: <?php echo $patient['gender'];?></p>
                    <p class="patient-details">Height: <?php echo isset($patient['height']) ? htmlspecialchars($patient['height']) : 'Not available'; ?> cm</p>
                    <p class="patient-details">Weight: <?php echo isset($patient['weight']) ? htmlspecialchars($patient['weight']) : 'Not available'; ?> kg</p>
                    <p class="patient-details">Diagnosis: <?php echo isset($patient['diagnosis']) ? htmlspecialchars($patient['diagnosis']) : 'Not available'; ?></p>
          </div>
        </div>
      </div>

      <!-- Notes Section -->
      
      <div class="notes-section">
        <form action="save_notes.php?id=<?php echo $patient_id?>" method="post">
          <textarea name="patient_notes" id="" cols="110" rows="10"><?php echo isset($patient_notes['notes']) ? htmlspecialchars($patient_notes['notes']) : ''; ?></textarea>
          <button type="submit" id="edit_save">Save</button>
        </form>

      </div>
    </div>
    <footer>
    <?php include_once ("../footer/therapist_footer.php")
    ?> 
    </footer>
    </footer>
    <script src="../../assets/js/patient-profile-charts.js"></script>
  </body>
</html>
