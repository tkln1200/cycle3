
<?php
    include_once '../../includes/connections.php';
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

       // getting journals
       $journal_count = mysqli_num_rows($sql_patient_journal_obj);
       if ($journal_count>0)
       {
          $journals = [];
          while ($row = mysqli_fetch_assoc($sql_patient_journal_obj)) {
              $journals[] = $row['title'];
          }
       }
       else
       {
        $journals = ["Not Available", "Not Available","Not Available","Not Available","Not Available"];

       }
    }
    

    
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
                    <p class="patient-details">Date of Birth: <?php echo isset($patient['dob']) ? htmlspecialchars($patient['dob']) : 'Not available'; ?></p>
                    <p class="patient-details">Gender: <?php echo $patient['gender'];?></p>
                    <p class="patient-details">Height: <?php echo isset($patient['height']) ? htmlspecialchars($patient['height']) : 'Not available'; ?> cm</p>
                    <p class="patient-details">Weight: <?php echo isset($patient['weight']) ? htmlspecialchars($patient['weight']) : 'Not available'; ?> kg</p>
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
        </div>

        <!-- Notes and Group Information Section -->
        <div class="notes-groups">
          <div class="group-container">
              <h2>Groups</h2>
                <!-- <button class="edit-btn">
                  <i class="fas fa-edit"></i>
                </button> -->
              <p class="patient-details">Group: <?php echo isset($patient_details['group_no']) ? htmlspecialchars($patient_details['group_no']) : 'Not available'; ?></p>
              <p class="patient-details">Sessions Completed: <?php echo isset($patient_details['completed_session']) ? htmlspecialchars($patient_details['completed_session']) : 'Not available'; ?></p>
              <p class="patient-details">Sessions Left: <?php echo isset($patient_details['total_session']) ? htmlspecialchars($patient_details['total_session']-$patient_details['completed_session']) : 'Not available'; ?></p>
              <p class="patient-details">Personal Progression: <?php echo isset($patient_details['progression']) ? htmlspecialchars($patient_details['progression']) : 'Not available'; ?></p>
          </div>
          <div class="notes-container">
            <div class="header-with-btn">
              <h2>Notes</h2>
              <button class="edit-btn" id="notesBtn">
                 <!-- <i class="fas fa-edit"></i> -->
                 <a href="patient_note.php?id=<?php echo $patient_id?>"><img src="/assets/images/note-btn.png" alt="Edit Notes" /></a>

                </button>
              </div>
              <ul class ="notes-details">
                <?php foreach ($notes_array as $note): ?>
                  <?php if (trim($note) !== ''): ?>
                      <li><?php echo htmlspecialchars(trim($note)) . '.'; ?></li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
          </div>
          <!-- <div class="calendar-container"> -->
            <div class="calendar-header">
                <button class="prev-month" onclick="prevMonth()">&lt;</button>
                <h2 id="month-name">September 2024</h2>
                <button class="next-month" onclick="nextMonth()">&gt;</button>
            </div>
    
            <div class="calendar-wrapper">
                <div class="calendar-grid" id="calendar-grid">
                    <!-- Weekdays -->
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                    
                    <!-- Days of the month will be generated by JavaScript -->
                </div>
            </div>
        </div>
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