
<?php
    include_once '../../includes/connections.php';
    $patient_id = $_GET['id'];
    $sql_patient  = "SELECT * FROM patient where id = $patient_id";
<<<<<<< HEAD
    $sql_patient_details  = "SELECT * FROM patient_details where patient_id = $patient_id";   
=======
    $sql_groups  = "SELECT 
                    gp.patient_id,
                    g.id AS group_id,
                    g.group_name,
                    g.space,
                    g.participants,
                    g.location,
                    g.date,
                    g.sTime,
                    g.eTime,
                    g.therapist_id,
                    g.occupied_space,
                    g.group_progress
                FROM 
                    group_patients gp
                JOIN 
                    groups g ON gp.group_id = g.id
                WHERE 
                    gp.patient_id = $patient_id";   
>>>>>>> 125aaa9 (update therapist create note + groups)
    $sql_patient_notes  = "SELECT * FROM notes where patient_id = $patient_id";
    $sql_journals = "SELECT * FROM journal where patientId = $patient_id";

    $sql_patient_obj = mysqli_query($conn,$sql_patient) Or die("Failed to query " . mysqli_error($conn));
<<<<<<< HEAD
    $sql_patient_details_obj = mysqli_query($conn,$sql_patient_details) Or die("Failed to query " . mysqli_error($conn));
=======
    $sql_groups_obj = mysqli_query($conn,$sql_groups) Or die("Failed to query " . mysqli_error($conn));

>>>>>>> 125aaa9 (update therapist create note + groups)
    $sql_patient_notes_obj = mysqli_query($conn,$sql_patient_notes) Or die("Failed to query " . mysqli_error($conn));
    $sql_patient_journal_obj = mysqli_query($conn,$sql_journals) Or die("Failed to query " . mysqli_error($conn));

    $count_patients = mysqli_num_rows($sql_patient_obj);
    if ($count_patients>0) {
       $patient = mysqli_fetch_assoc($sql_patient_obj);
       $patient_details = mysqli_fetch_assoc($sql_patient_details_obj);
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
              $journals[] = $row['details'];
          }
       }
       else
       {
        $journals = ["Not Available", "Not Available","Not Available","Not Available","Not Available"];

       }
       //getting group details
       $groups = [];
       while ($group_row = mysqli_fetch_assoc($sql_groups_obj)) {
           $groups[] = $group_row;
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
                    <p class="patient-details">Age: <?php echo isset($patient_details['age']) ? htmlspecialchars($patient_details['age']) : 'Not available'; ?></p>
                    <p class="patient-details">Gender: <?php echo $patient['gender'];?></p>
                    <p class="patient-details">Height: <?php echo isset($patient_details['height']) ? htmlspecialchars($patient_details['height']) : 'Not available'; ?></p>
                    <p class="patient-details">Weight: <?php echo isset($patient_details['weight']) ? htmlspecialchars($patient_details['weight']) : 'Not available'; ?> KG</p>
                    <p class="patient-details">Diagnosis: <?php echo isset($patient_details['diagnosis']) ? htmlspecialchars($patient_details['diagnosis']) : 'Not available'; ?></p>
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

        <!-- Notes and Group Information Section -->
        <div class="notes-groups">
          <div class="group-container">
              <h2>Groups</h2>
                <!-- <button class="edit-btn">
                  <i class="fas fa-edit"></i>
                </button> -->
                <?php if (count($groups) > 0): ?>
                <?php foreach ($groups as $group): ?>
                    <div class="group-details">
                        <p class="patient-details">Group Name: <?php echo htmlspecialchars($group['group_name']); ?></p>
                        <p class="patient-details">Location: <?php echo htmlspecialchars($group['location']); ?></p>
                        <p class="patient-details">Date: <?php echo htmlspecialchars($group['date']); ?></p>
                        <p class="patient-details">Start Time: <?php echo htmlspecialchars($group['sTime']); ?></p>
                        <p class="patient-details">End Time: <?php echo htmlspecialchars($group['eTime']); ?></p>
                        <p class="patient-details">Occupied Space: <?php echo htmlspecialchars($group['occupied_space']) . '/' . htmlspecialchars($group['space']); ?></p>
                        <p class="patient-details">Group Progress: <?php echo htmlspecialchars($group['group_progress']) . '%'; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="patient-details">No group information available for this patient.</p>
            <?php endif; ?>
          </div>
          <div class="notes-container">
            <div class="header-with-btn">
              <h2>Notes</h2>
              <button class="edit-btn" id="notesBtn" onclick="window.location.href='patient_note.php?id=<?php echo $patient_id; ?>'">Edit Note
              <img src="../../assets/images/note-btn.png" alt="Edit Notes" />
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