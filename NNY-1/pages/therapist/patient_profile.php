<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="../../assets/css/patient_profile.css">
    <link rel="stylesheet" href="../../assets/css/therapist.css">
    <link rel="stylesheet" href="../../styles/therapist-dashboard.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> -->

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
                    <h2>Zoe Ashford</h1>
                    <p class="patient-details">Age: 25</p>
                    <p class="patient-details">Gender: Female</p>
                    <p class="patient-details">Height: 5 ft 4 in</p>
                    <p class="patient-details">Weight: 56 KG</p>
                    <p class="patient-details">Diagnosis: Generalized Anxiety Disorder</p>
                </div>
            </div>

            <!-- Recent Journal Section -->
            <div class="journal-section">
                <h2>Recent Journal</h2>
                <div class="patient-journel" id="boxContainer">
                  <div class="patient-box">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.   Commodi numquam vero sed beatae nam, ipsam itaque cumque quisquam. Saepe reiciendis quasi aperiam quidem voluptatum similique id ad beatae ut fugit?
                  </div>
                  <div class="patient-box">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam vero sed beatae nam, ipsam itaque cumque quisquam. Saepe reiciendis quasi aperiam quidem voluptatum similique id ad beatae ut fugit?
                  </div>
                  <div class="patient-box">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam vero sed beatae nam, ipsam itaque cumque quisquam. Saepe reiciendis quasi aperiam quidem voluptatum similique id ad beatae ut fugit?
                  </div>
              </div>
              <div class="navigation">
                <button id="prevBtn" onclick="showPrevious()">Previous</button>
                <button id="nextBtn" onclick="showNext()">Next</button>
              </div>

            </div>

            <!-- Recent Mood Chart -->
            <div class="mood-chart">
                <h2>Recent Activity - Mood Level</h2>
                <canvas id="lineChart" width="600" height="400"></canvas>
              </div>
        </div>

        <!-- Notes and Group Information Section -->
        <div class="notes-groups">
          <div class="group-container">
              <h2>Groups</h2>
                <!-- <button class="edit-btn">
                  <i class="fas fa-edit"></i>
                </button> -->
              <p class="patient-details">Group: 2</p>
              <p class="patient-details">Sessions Completed: 3</p>
              <p class="patient-details">Sessions Left: 2</p>
              <p class="patient-details">Personal Progression: 10%</p>
              <p class="patient-details">Group Progression: 62%</p>
          </div>
          <div class="notes-container">
            <div class="header-with-btn">
              <h2>Notes</h2>
              <button class="edit-btn" id="notesBtn">
                 <!-- <i class="fas fa-edit"></i> -->
                 <img src="/assets/images/note-btn.png" alt="Edit Notes" />

                </button>
              </div>
              <ul class ="notes-details">
                  <li>The patient reports persistent feelings of hopelessness for months.</li>
                  <li>Describes significant fatigue and loss of interest in previously enjoyed activities.</li>
                  <li>Expresses feelings of worthlessness and negative self-perception.</li>
                  <li>Social withdrawal observed; reduced contact with friends and family.</li>
              </ul>
          </div>
          <div class="calendar-container">
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
    <script src="../../assets/js/patient-profile.js"></script>
    <script src="../../assets/js/patient-profile-charts.js"></script>

</body>
</html>