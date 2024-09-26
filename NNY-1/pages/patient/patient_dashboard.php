<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient</title>
  <link rel="stylesheet" href="../../assets/css/patient.css" />
  <link rel="stylesheet" href="../../assets/css/shared.css" />
</head>

<body>
  <header>
    <?php
    include_once("../navigation/patient_nav.php");
    require_once "patient-dashboard-connect.php";

    // Check if the request is a POST request and handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $title = isset($_POST['goalTitle']) ? $_POST['goalTitle'] : '';
      $category = isset($_POST['goalCategory']) ? $_POST['goalCategory'] : '';
      $dueDate = isset($_POST['dueDate']) ? $_POST['dueDate'] : '';

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare the SQL insert statement
      $sql = "INSERT INTO GOAL (title, category, dueDate) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);

      // Check if the statement was prepared successfully
      if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
      }

      // Bind parameters to the prepared statement
      $stmt->bind_param("sss", $title, $category, $dueDate);

      // Execute the statement and check for errors
      if ($stmt->execute()) {
        echo "New goal record inserted successfully.";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close the statement
      $stmt->close();
    }

    // Fetch the latest goal
    $latestGoal = "";
    $latestGoalCategory = "";
    $latestGoalDueDate = "";

    $sql = "SELECT title FROM GOAL ORDER BY goalId DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $latestGoal = $row['title'];
    }

    // Close the connection after all queries have been executed
    $conn->close();
    ?>

  </header>
  <main>
    <div class="container">
      <!-- Left Panel -->
      <div class="left-panel">
        <div class="greetings">Hi, Zoe!</div>
        <div class="affirmation-slider">
          <div class="quote active">
            “I am grateful for the life I am living.”
          </div>
          <div class="quote">
            “I choose to be happy and love myself today.”
          </div>
          <div class="quote">
            “I am in control of my emotions and thoughts.”
          </div>
          <div class="quote">“I am becoming the best version of myself.”</div>
        </div>

        <div class="dots">
          <span class="dot active" data-quote="0"></span>
          <span class="dot" data-quote="1"></span>
          <span class="dot" data-quote="2"></span>
          <span class="dot" data-quote="3"></span>
        </div>
        <div class="goal-for-week">
          <h2><a href="#" id="goalLink">Your goal for this week:</a></h2>
          <p id="weeklyGoalText">

          </p>
          <button id="setGoalButton">Set a Goal</button>
        </div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const latestGoal = "<?php echo isset($latestGoal) ? $latestGoal : ''; ?>";
            const latestGoalCategory = "<?php echo isset($latestGoalCategory) ? $latestGoalCategory : ''; ?>";
            const latestGoalDueDate = "<?php echo isset($latestGoalDueDate) ? $latestGoalDueDate : ''; ?>";

            // Update the weeklyGoalText with the latest goal
            if (latestGoal) {
              document.getElementById('weeklyGoalText').textContent = latestGoal;
            } else {
              document.getElementById('weeklyGoalText').textContent = "No goal set for this week.";
            }
          });
        </script>

        <div id="newGoalModal" class="new-modal">
          <div class="new-modal-content">
            <span class="close">&times;</span>
            <h2>Set a New Goal</h2>
            <form id="goalForm" method="POST" action="patient_dashboard.php">
              <label for="goalTitle">Title:</label>
              <input type="text" id="goalTitle" name="goalTitle" required>
              <label for="goalCategory">Category:</label>
              <!-- <input type="text" id="goalCategory" name="goalCategory" required> -->
              <select name="goalCategory" id="goalCategory">
                <option value="generalGoal">General Goal</option>
                <option value="eatingGoal">Eating Goal</option>
                <option value="exerciseGoal">Exercise Goal</option>
                <option value="careerGoal">Career Goal</option>
              </select>
              <label for="dueDate">Due Date:</label>
              <input type="date" id="dueDate" name="dueDate" required>
              <button type="submit" id="submitGoalButton">Save Goal</button>
            </form>
          </div>
        </div>

        <div id="goalModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Weekly Goal Details</h2>
            <p>
              “I am going to control my alcoholism and shall be more
              positive.”
            </p>
            <button id="completeGoal">Complete</button>
          </div>
        </div>

        <div id="congratsMessage" class="congrats-message">
          <div id="confetti"></div>
          <h2>Well done, Zoe!</h2>
        </div>
      </div>

      <!-- Right Panel -->
      <div class="right-panel">
        <div class="calendar-container">
          <div class="calendar-header">
            <button id="prevMonth" onclick="prevMonth()">&lt;</button>
            <h2 id="month-name">September 2024</h2>
            <button id="nextMonth" onclick="nextMonth()">&gt;</button>
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

        <div class="chart-container">
          <h2>Recent Activity - Mood Level</h2>
          <canvas id="lineChart" width="500" height="150"></canvas>
        </div>
      </div>
  </main>
  <footer>
    <?php include_once("../footer/patient_footer.php")
    ?>

  </footer>
  <script src="../../components/patient/patient.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      var savedGoalTitle = "<?php echo isset($goalTitle) ? $goalTitle : ''; ?>";
      var savedGoalCategory = "<?php echo isset($goalCategory) ? $goalCategory : ''; ?>";
      var savedGoalDueDate = "<?php echo isset($goalDueDate) ? $goalDueDate : ''; ?>";

      if (savedGoalTitle) {
        document.getElementById('weeklyGoalText').textContent = savedGoalTitle;
      }
    });
  </script>
</body>

</html>