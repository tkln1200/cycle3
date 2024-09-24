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
            <h2>Zoe Ashford</h2>
            <p class="patient-details">Issues: Depression</p>
            <p class="patient-details">Age: 33</p>
            <p class="patient-details">Gender: Female</p>
            <p class="patient-details">Height: 5 ft 4 inch</p>
            <p class="patient-details">Weight: 56 KG</p>
          </div>
        </div>
      </div>

      <!-- Notes Section -->
      <div class="notes-section">
        <ul>
          <li>
            The patient reports persistent low mood and feelings of hopelessness
            for the past six months.
          </li>
          <li>
            Describes significant fatigue and loss of interest in previously
            enjoyable activities.
          </li>
          <li>
            Expresses feelings of worthlessness and negative self-perception.
          </li>
          <li>
            Social withdrawal observed; patient has reduced contact with friends
            and family.
          </li>
        </ul>
        <!-- Recent Mood Chart -->
        <div class="mood-chart">
          <h2>Recent Activity - Mood Level</h2>
          <canvas id="lineChart" width="600" height="400"></canvas>
        </div>
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
