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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['goalTitle'])) {
      $title = isset($_POST['goalTitle']) ? $_POST['goalTitle'] : '';
      $category = isset($_POST['goalCategory']) ? $_POST['goalCategory'] : '';
      $dueDate = isset($_POST['dueDate']) ? $_POST['dueDate'] : '';

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "INSERT INTO GOAL (title, category, dueDate) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);

      if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
      }

      $stmt->bind_param("sss", $title, $category, $dueDate);

      if ($stmt->execute()) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['completedGoals'])) {
      $completedGoals = $_POST['completedGoals'];
      foreach ($completedGoals as $goalId) {
        $updateSql = "UPDATE GOAL SET isCompleted = 1 WHERE goalId = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("i", $goalId);
        $stmt->execute();
        $stmt->close();
      }
      echo "<script>alert('Selected goals marked as complete!');</script>";
    }

    $incompleteGoals = [];
    $sql = "SELECT goalId, title, category, dueDate FROM GOAL WHERE isCompleted = 0 ORDER BY goalId ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $incompleteGoals[] = $row;
      }
    }

    $selectedAffirmations = [];
    $sql = "SELECT description FROM affirmation WHERE isSelected = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $selectedAffirmations[] = $row['description'];
      }
    }

    $conn->close();
    ?>

  </header>
  <main>
    <div class="container">
      <div class="left-panel">
        <div class="greetings">Hi, Zoe!</div>

        <!-- Affirmation Slider -->
        <div class="affirmation-slider">
          <?php if (!empty($selectedAffirmations)): ?>
            <?php foreach ($selectedAffirmations as $index => $affirmation): ?>
              <div class="quote <?php echo $index === 0 ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($affirmation); ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="quote active">No affirmations selected.</div>
          <?php endif; ?>
        </div>

        <!-- Slider Dots -->
        <div class="dots">
          <?php if (!empty($selectedAffirmations)): ?>
            <?php foreach ($selectedAffirmations as $index => $affirmation): ?>
              <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" data-quote="<?php echo $index; ?>"></span>
            <?php endforeach; ?>
          <?php else: ?>
            <span class="dot active" data-quote="0"></span>
          <?php endif; ?>
        </div>

        <!-- Weekly Goal Section -->
        <div class="goal-for-week">
          <h2><a href="#" id="goalLink">Your goal for this week:</a></h2>
          <p id="weeklyGoalText">
            <?php echo !empty($incompleteGoals) ? $incompleteGoals[0]['title'] : 'No goal set for this week.'; ?>
          </p>
          <button id="setGoalButton">Set a Goal</button>
        </div>

        <!-- Modal for Viewing and Completing Goals -->
        <div id="goalModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Weekly Goal Details</h2>

            <?php if (!empty($incompleteGoals)): ?>
              <form id="completeGoalForm" method="POST" action="">
                <?php foreach ($incompleteGoals as $goal): ?>
                  <div class="goal-item">
                    <input type="checkbox" name="completedGoals[]" value="<?php echo $goal['goalId']; ?>">
                    <label for="goal-<?php echo $goal['goalId']; ?>">
                      <?php echo htmlspecialchars($goal['title']); ?>
                      <span>(<?php
                              if ($goal['category'] == "generalGoal") {
                                echo "General Goal";
                              } elseif ($goal['category'] == "eatingGoal") {
                                echo "Eating Goal";
                              } elseif ($goal['category'] == "exerciseGoal") {
                                echo "Exercise Goal";
                              } else {
                                echo "Career Goal";
                              }
                              ?>, Due: <?php echo htmlspecialchars($goal['dueDate']); ?>)</span>
                    </label>
                  </div>
                <?php endforeach; ?>
                <button type="submit" id="completeGoal">Complete</button>
              </form>
            <?php else: ?>
              <p>No incomplete goals.</p>
              <button id="completeGoal" disabled>Complete</button>
            <?php endif; ?>
          </div>
        </div>

        <!-- Modal for Setting Goals -->
        <div id="newGoalModal" class="new-modal">
          <div class="new-modal-content">
            <span class="close">&times;</span>
            <h2>Set a New Goal</h2>
            <form id="goalForm" method="POST" action="patient_dashboard.php">
              <label for="goalTitle">Title:</label>
              <input type="text" id="goalTitle" name="goalTitle" required>
              <label for="goalCategory">Category:</label>
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

        <div id="congratsMessage" class="congrats-message">
          <div id="confetti"></div>
          <h2>Well done, Zoe!</h2>
        </div>
      </div>

      <div class="right-panel">
        <div class="calendar-container">
          <div class="calendar-header">
            <button id="prevMonth" onclick="prevMonth()">&lt;</button>
            <h2 id="month-name">September 2024</h2>
            <button id="nextMonth" onclick="nextMonth()">&gt;</button>
          </div>
          <div class="calendar-wrapper">
            <div class="calendar-grid" id="calendar-grid">
              <div class="weekday">Sun</div>
              <div class="weekday">Mon</div>
              <div class="weekday">Tue</div>
              <div class="weekday">Wed</div>
              <div class="weekday">Thu</div>
              <div class="weekday">Fri</div>
              <div class="weekday">Sat</div>
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
    <?php include_once("../footer/patient_footer.php") ?>
  </footer>
  <script src="../../components/patient/patient.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const goalLink = document.getElementById("goalLink");
      const goalModal = document.getElementById("goalModal");
      const closeModal = document.querySelector(".modal .close");

      goalLink.addEventListener("click", (event) => {
        event.preventDefault();
        goalModal.style.display = "block";
      });

      closeModal.addEventListener("click", () => {
        goalModal.style.display = "none";
      });
    });
  </script>

</body>

</html>