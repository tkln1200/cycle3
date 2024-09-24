<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Activity Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/shared.css" />
    <link rel="stylesheet" href="../../assets/css/patient.css" />
    <link rel="stylesheet" href="../../assets/css/activity-dashboard.css" />
  </head>
  <body>
    <header>
      <?php include_once ("../navigation/patient_nav.php")
      ?> 
    </header>
    <main class="dashboard-container">
      <h2>Activity Dashboard</h2>
      <button
        class="create-activity-button"
        onclick="location.href='activity-tracker.html'"
      >
        Create Activity Tracker
      </button>
      <section id="eating-habits">
        <h3>Eating Habits</h3>
        <ul class="task-list" id="eating-habits-list">
          <!-- Tasks will be dynamically added here -->
        </ul>
      </section>

      <section id="exercise-habits">
        <h3>Exercise Habits</h3>
        <ul class="task-list" id="exercise-habits-list">
          <!-- Tasks will be dynamically added here -->
        </ul>
      </section>

      <section id="sleeping-habits">
        <h3>Sleeping Habits</h3>
        <ul class="task-list" id="sleeping-habits-list">
          <!-- Tasks will be dynamically added here -->
        </ul>
      </section>
    </main>
    <footer>
      <?php
      include_once ("../footer/patient_footer.php")
      ?>
    </footer>
    <script src="../../components/patient/activity-dashboard.js"></script>
  </body>
</html>
