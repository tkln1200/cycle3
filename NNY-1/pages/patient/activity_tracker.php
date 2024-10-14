<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Activity Tracker</title>
  <link rel="stylesheet" href="../../assets/css/shared.css" />
  <link rel="stylesheet" href="../../assets/css/patient.css" />
  <link rel="stylesheet" href="../../assets/css/activity-tracker.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header>
    <nav id="shared-header-patient">
      <?php include_once("../navigation/patient_nav.php") ?>
    </nav>
  </header>

  <main class="activity-tracker-main">
    <div class="activity-header">
      <h2 style = "padding-left: 20px;">Activity Tracker</h2>
      <button class="view-list-btn" onclick="window.location.href='activity_dashboard.php'">View List</button>
    </div>

    <div class="content-container">
      <form id="activity-tracker-form" class="activity-tracker-section" method="POST" action="activity_tracker.php">
        <section class="activity-tracker-section">
          <h3><span class="icon sleep-icon"><i class="fas fa-bed"></i></span> Sleep</h3>
          <div class="rating-buttons">
            <?php for ($i = 10; $i >= 1; $i--): ?>
              <button type="button" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
          </div>
          <input type="hidden" name="sleepRating" id="sleepRating" />
          <textarea class="activity-notes" name="sleepNotes" placeholder="Your notes here"></textarea>
        </section>

        <section class="activity-tracker-section">
          <h3><span class="icon food-icon"><i class="fas fa-utensils"></i></span> Food</h3>
          <div class="rating-buttons">
            <?php for ($i = 10; $i >= 1; $i--): ?>
              <button type="button" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
          </div>
          <input type="hidden" name="foodRating" id="foodRating" />
          <textarea class="activity-notes" name="foodNotes" placeholder="Your notes here"></textarea>
        </section>

        <section class="activity-tracker-section">
          <h3><span class="icon water-icon"><i class="fas fa-tint"></i></span> Water</h3>
          <div class="rating-buttons">
            <?php for ($i = 10; $i >= 1; $i--): ?>
              <button type="button" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
          </div>
          <input type="hidden" name="waterRating" id="waterRating" />
          <textarea class="activity-notes" name="waterNotes" placeholder="Your notes here"></textarea>
        </section>

        <section class="activity-tracker-section">
          <h3><span class="icon exercise-icon"><i class="fas fa-dumbbell"></i></span> Exercise</h3>
          <div class="rating-buttons">
            <?php for ($i = 10; $i >= 1; $i--): ?>
              <button type="button" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
          </div>
          <input type="hidden" name="exerciseRating" id="exerciseRating" />
          <textarea class="activity-notes" name="exerciseNotes" placeholder="Your notes here"></textarea>
        </section>

        <button class="publish-btn" type="submit">Publish</button>
      </form>

      <!-- <div class="side-section">
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
        <div id="journalModal" class="modal" style="<?php echo isset($journal) ? 'display: block;' : 'display: none;'; ?>">
        <div class="modal-content">
          <span class="close" onclick="document.getElementById('journalModal').style.display='none'">&times;</span>
          <?php if ($journal): ?>
            <h2><?php echo htmlspecialchars($journal['title']); ?></h2>
            <p><?php echo htmlspecialchars($journal['details']); ?></p>
            <p><strong>Mood Level:</strong> <?php echo htmlspecialchars($journal['moodLevel']); ?></p>
          <?php else: ?>
            <p>No journal entry found for this date.</p>
          <?php endif; ?>
        </div>
      </div>

        <div id="goalSection">
          <h2>Your goal for this week:</h2>
          <p id="weeklyGoalText">
            <?php
            require_once "../../includes/connections.php";
            $sql = "SELECT title FROM GOAL ORDER BY goalId DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo $row['title'];
            } else {
              echo "No goal set for this week.";
            }
            ?>
          </p>
        </div>
      </div> -->
    </div>
  </main>

  <footer>
    <?php include_once("../footer/patient_footer.php") ?>
  </footer>
  <script src="../../components/patient/activity-tracker.js"></script>
  <script src="../../components/patient/patient.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const buttons = document.querySelectorAll('.rating-buttons button');

      buttons.forEach(button => {
        button.addEventListener('click', function() {
          const ratingValue = this.getAttribute('data-rating');
          const section = this.closest('section');
          const hiddenInput = section.querySelector('input[type="hidden"]');

          const siblings = this.parentNode.querySelectorAll('button');
          siblings.forEach(sibling => sibling.classList.remove('active'));

          this.classList.add('active');
          hiddenInput.value = ratingValue;
        });
      });
    });
  </script>
</body>

</html>

<?php
require_once "../../includes/connections.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sleepRating = $_POST['sleepRating'] ?: 0;
  $sleepNotes = $_POST['sleepNotes'] ?: null;
  $foodRating = $_POST['foodRating'] ?: 0;
  $foodNotes = $_POST['foodNotes'] ?: null;
  $waterRating = $_POST['waterRating'] ?: 0;
  $waterNotes = $_POST['waterNotes'] ?: null;
  $exerciseRating = $_POST['exerciseRating'] ?: 0;
  $exerciseNotes = $_POST['exerciseNotes'] ?: null;
  $createdDate = date('Y-m-d');

  $sql = "INSERT INTO activity (sleepRating, sleepNotes, foodRating, foodNotes, waterRate, waterNotes, exerciseRating, exerciseNotes, createdDate)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isisisiss", $sleepRating, $sleepNotes, $foodRating, $foodNotes, $waterRating, $waterNotes, $exerciseRating, $exerciseNotes, $createdDate);

  if ($stmt->execute()) {
    echo "<script>alert('Activity log saved successfully!');</script>";
  } else {
    echo "<script>alert('Error saving activity log: " . $stmt->error . "');</script>";
  }

  $stmt->close();
}

$journal = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedDate'])) {
      $selectedDate = $_POST['selectedDate'];

      $sql = "SELECT title, details, moodLevel FROM journal WHERE dateCreated = ? ORDER BY id DESC LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selectedDate);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $journal = $result->fetch_assoc();
      }
    }

    $conn->close();
?>