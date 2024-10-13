
<?php
    include_once '../../includes/connections.php';
    $patient_id = $_GET['id'];
    $sql_patient  = "SELECT * FROM patient where id = $patient_id";
    $stmt_patient = $conn->prepare($sql_patient);
    $stmt_patient->bind_param("i", $patient_id);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();

    if ($result_patient->num_rows > 0) {
      $patient = $result_patient->fetch_assoc();
    }
      // Process notes if they exist
      // if (isset($patient_notes['notes'])) {
      //     $notes_array = explode('.', $patient_notes['notes']);
      // }

    // $sql_patient_details  = "SELECT * FROM patient_details where patient_id = $patient_id";   
    // $sql_patient_notes  = "SELECT * FROM notes where patient_id = $patient_id";
    // $sql_journals = "SELECT * FROM journal where patientId = $patient_id";

    // $sql_patient_obj = mysqli_query($conn,$sql_patient) Or die("Failed to query " . mysqli_error($conn));
    // $sql_patient_details_obj = mysqli_query($conn,$sql_patient_details) Or die("Failed to query " . mysqli_error($conn));

    // $sql_patient_notes_obj = mysqli_query($conn,$sql_patient_notes) Or die("Failed to query " . mysqli_error($conn));

    // $sql_patient_journal_obj = mysqli_query($conn,$sql_journals) Or die("Failed to query " . mysqli_error($conn));

    // $count_patients = mysqli_num_rows($sql_patient_obj);
    // if ($count_patients>0) {
    //    $patient = mysqli_fetch_assoc($sql_patient_obj);
    //    $patient_details = mysqli_fetch_assoc($sql_patient_details_obj);
    //    $patient_notes =  mysqli_fetch_assoc($sql_patient_notes_obj);
    //    if(isset($patient_notes['notes']))
    //    {
    //       $notes_array = explode('.', $patient_notes['notes']);
    //    }

    //    // getting journals
    //    $journal_count = mysqli_num_rows($sql_patient_journal_obj);
    //    if ($journal_count>0)
    //    {
    //       $journals = [];
    //       while ($row = mysqli_fetch_assoc($sql_patient_journal_obj)) {
    //           $journals[] = $row['title'];
    //       }
    //    }
    //    else
    //    {
    //     $journals = ["Not Available", "Not Available","Not Available","Not Available","Not Available"];

    //    }
    

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="../../assets/css/patient_profile.css">
    <link rel="stylesheet" href="../../assets/css/therapist.css">
    <link rel="stylesheet" href="../../styles/therapist-dashboard.css">

</head>
<body>
<header>
    <?php include_once ("../navigation/therapist_nav.php")
    ?> 
</header>
  <div class="container">
        <!-- Top-left patient profile section -->
        <div class="patient-profile">
            <h1>Patient Details</h1>
            <div class="profile-header">
                <img src="../../assets/images/patient.png" alt="Patient Photo" class="profile-photo">
                <div class="patient-info">
                    <h2><?php echo $patient['fName'] ." " .  $patient['lName'];?></h2>
                    <p class="patient-details">Age: <?php echo isset($patient['dob']) ? htmlspecialchars($patient['dob']) : 'Not available'; ?></p>
                    <p class="patient-details">Gender: <?php echo $patient['gender'];?></p>
                    <p class="patient-details">Height: <?php echo isset($patient['height']) ? htmlspecialchars($patient['height']) : 'Not available'; ?>cm</p>
                    <p class="patient-details">Weight: <?php echo isset($patient['weight']) ? htmlspecialchars($patient['weight']) : 'Not available'; ?>kg</p>
                    <p class="patient-details">Diagnosis: <?php echo isset($patient['diagnosis']) ? htmlspecialchars($patient['diagnosis']) : 'Not available'; ?></p>
                </div>
            </div>

            <!-- Recent Journal Section -->
            <div class="journal-section">
              <h2>Recent Journal</h2>
              <div class="patient-journel" id="boxContainer"></div>
              <div class="navigation">
                  <button id="prevBtn">Previous</button>
                  <button id="nextBtn">Next</button>
              </div>

            </div>

            <!-- Recent Mood Chart -->
            <!-- <div class="mood-chart">
                <h2>Recent Activity - Mood Level</h2>
                <canvas id="lineChart" width="600" height="400"></canvas>
              </div> -->
        </div>

        
    </div>
  </div>
    <footer>
    <?php include_once ("../footer/therapist_footer.php")
    ?> 
    </footer>
    <script>
      const journals = <?php echo json_encode($journals); ?>;
    </script>
    <script src="../../assets/js/patient-profile.js"></script>
    <script src="../../assets/js/patient-profile-charts.js"></script>

</body>
</html>