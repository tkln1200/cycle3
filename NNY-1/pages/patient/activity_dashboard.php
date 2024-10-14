<?php
require_once "../../includes/connections.php";

$todayDate = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $activityId = isset($_POST['activityId']) ? $_POST['activityId'] : null;
  $sleepRating = isset($_POST['sleepRating']) ? $_POST['sleepRating'] : null;
  $sleepNotes = isset($_POST['sleepNotes']) ? $_POST['sleepNotes'] : null;
  $foodRating = isset($_POST['foodRating']) ? $_POST['foodRating'] : null;
  $foodNotes = isset($_POST['foodNotes']) ? $_POST['foodNotes'] : null;
  $waterRating = isset($_POST['waterRating']) ? $_POST['waterRating'] : null;
  $waterNotes = isset($_POST['waterNotes']) ? $_POST['waterNotes'] : null;
  $exerciseRating = isset($_POST['exerciseRating']) ? $_POST['exerciseRating'] : null;
  $exerciseNotes = isset($_POST['exerciseNotes']) ? $_POST['exerciseNotes'] : null;

  if ($activityId) {
    // Update existing entry
    $updateSql = "UPDATE activity 
                    SET sleepRating = ?, sleepNotes = ?, foodRating = ?, foodNotes = ?, 
                        waterRate = ?, waterNotes = ?, exerciseRating = ?, exerciseNotes = ? 
                    WHERE activityId = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param(
      "isisisisi",
      $sleepRating,
      $sleepNotes,
      $foodRating,
      $foodNotes,
      $waterRating,
      $waterNotes,
      $exerciseRating,
      $exerciseNotes,
      $activityId
    );
    $updateStmt->execute();
    $updateStmt->close();
  }
}

$sql = "SELECT activityId, sleepRating, sleepNotes, foodRating, foodNotes, waterRate, waterNotes, exerciseRating, exerciseNotes 
        FROM activity WHERE createdDate = ? ORDER BY activityId DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $todayDate);
$stmt->execute();
$stmt->store_result();

$activityId = $sleepRating = $sleepNotes = $foodRating = $foodNotes = $waterRate = $waterNotes = $exerciseRating = $exerciseNotes = '';

if ($stmt->num_rows > 0) {
  $stmt->bind_result($activityId, $sleepRating, $sleepNotes, $foodRating, $foodNotes, $waterRate, $waterNotes, $exerciseRating, $exerciseNotes);
  $stmt->fetch();
}
$stmt->close();

$sqlRecent = "SELECT activityId, createdDate, sleepRating, foodRating, waterRate, exerciseRating FROM activity ORDER BY activityId DESC";
$resultRecent = $conn->query($sqlRecent);

?>

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
    <nav id="shared-header-patient">
      <?php include_once("../navigation/patient_nav.php") ?>
    </nav>
  </header>

  <main class="activity-tracker-main">
    <h2 style="padding-left:20px">Activity Dashboard</h2>

    <div class="content-container">
      <div class="form-section">
        <div class="form-header">
          <h2>Your Lastest Log</h2>
          <button class="create-log-btn" onclick="window.location.href='activity_tracker.php'">Create a New Log</button>
        </div>
        <form id="activity-tracker-form" class="activity-tracker-section" method="POST" action="activity_dashboard.php">
          <input type="hidden" name="activityId" value="<?php echo htmlspecialchars($activityId); ?>">
          <section class="activity-tracker-section">
            <h3><span class="icon sleep-icon"></span> Sleep</h3>
            <div class="rating-and-notes">
              <div class="rating-buttons">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                  <button type="button" class="<?php echo ($sleepRating == $i) ? 'active' : ''; ?>" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="sleepRating" value="<?php echo $sleepRating; ?>">
              <textarea class="activity-notes" name="sleepNotes" placeholder="Enter notes here"><?php echo htmlspecialchars($sleepNotes); ?></textarea>
            </div>
          </section>

          <section class="activity-tracker-section">
            <h3><span class="icon food-icon"></span> Food</h3>
            <div class="rating-and-notes">
              <div class="rating-buttons">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                  <button type="button" class="<?php echo ($foodRating == $i) ? 'active' : ''; ?>" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="foodRating" value="<?php echo $foodRating; ?>">
              <textarea class="activity-notes" name="foodNotes" placeholder="Enter notes here"><?php echo htmlspecialchars($foodNotes); ?></textarea>
            </div>
          </section>

          <!-- Water Log Section -->
          <section class="activity-tracker-section">
            <h3><span class="icon water-icon"></span> Water</h3>
            <div class="rating-and-notes">
              <div class="rating-buttons">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                  <button type="button" class="<?php echo ($waterRate == $i) ? 'active' : ''; ?>" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="waterRating" value="<?php echo $waterRating; ?>">
              <textarea class="activity-notes" name="waterNotes" placeholder="Enter notes here"><?php echo htmlspecialchars($waterNotes); ?></textarea>
            </div>
          </section>

          <section class="activity-tracker-section">
            <h3><span class="icon exercise-icon"></span> Exercise</h3>
            <div class="rating-and-notes">
              <div class="rating-buttons">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                  <button type="button" class="<?php echo ($exerciseRating == $i) ? 'active' : ''; ?>" data-rating="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="exerciseRating" value="<?php echo $exerciseRating; ?>">
              <textarea class="activity-notes" name="exerciseNotes" placeholder="Enter notes here"><?php echo htmlspecialchars($exerciseNotes); ?></textarea>
            </div>
          </section>

          <button class="publish-btn" type="submit">Confirm Edit</button>
        </form>

        <div class="recent-logs">
          <h3>Your Recent Logs</h3>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Sleep</th>
                <th>Food</th>
                <th>Water</th>
                <th>Exercise</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($resultRecent->num_rows > 0): ?>
                <?php while ($row = $resultRecent->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo date("jS F, Y", strtotime($row['createdDate'])); ?></td>
                    <td><?php echo htmlspecialchars($row['sleepRating']); ?></td>
                    <td><?php echo htmlspecialchars($row['foodRating']); ?></td>
                    <td><?php echo htmlspecialchars($row['waterRate']); ?></td>
                    <td><?php echo htmlspecialchars($row['exerciseRating']); ?></td>
                    <input type="hidden" name="activitiId" value="<?php echo htmlspecialchars($row['activityId']); ?>">
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5">No recent logs available.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- <div class="side-section">
        <div class="calendar-container">
          <div class="calendar-header">
            <button id="prevMonth" onclick="prevMonth()">&lt;</button>
            <h2 id="month-name">March 2024</h2>
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

        <div id="goalSection">
          <h2>Your goal for this week:</h2>
          <p id="weeklyGoalText">
            <?php
            // Fetch the latest goal
            $sql = "SELECT title FROM GOAL ORDER BY goalId DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo htmlspecialchars($row['title']);
            } else {
              echo "No goal set for this week.";
            }
            $conn->close();
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