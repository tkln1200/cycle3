<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Journal</title>
    <link rel="stylesheet" href="../../assets/css/patient.css" />
    <link rel="stylesheet" href="../../assets/css/shared.css" />
  </head>
  <body>
    <header>
    <?php 
      session_start();
      include_once ("../navigation/patient_nav.php");
      require_once "patient_journal_connect.php";
      
      if (!isset($_SESSION['patientId'])) {
        // Redirect to login page if the patient is not logged in
        header("Location: ../login/patient_login.php");
        exit();
      }
      
      $patientId = $_SESSION['patientId'];
      
      $query = "SELECT * FROM Journal WHERE id = ?";      
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $patientId);
      $stmt->execute();
      $result = $stmt->get_result();
      $journals = [];
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $journals[] = $row;
          }
      }

      // Fetch the patient's therapistId
      $query = "SELECT therapistId FROM Patient WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $patientId);
      $stmt->execute();
      $result = $stmt->get_result();
      $therapistId = null;

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $therapistId = $row['therapistId']; // Retrieve the therapistId associated with the patient
      }    

      // Handle the form submission for adding a new journal entry 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $details = $_POST['details'];
        $moodLevel = $_POST['moodLevel'];
        $dateCreated = $_POST['dateCreated'];
        $timeCreated = $_POST['timeCreated'];
        
        // Initialize fileContent
        $fileContent = null;
        
        // Check if a file was uploaded
        if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['mediaUpload']['tmp_name'];
            $fileContent = file_get_contents($fileTmpPath); // Read the file content
        } else {
            // Handle the error for file upload
            echo "Error uploading file. Please try again.";
            // You may want to set $fileContent to a default value or NULL if the file is not necessary
        }

        // Prepare to insert the new journal entry, using the retrieved therapistId
        $insertQuery = "INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        
        // Bind parameters: 'i' for integer, 's' for string, 'b' for blob
        $insertStmt->bind_param("iissssib", $patientId, $therapistId, $title, $dateCreated, $timeCreated, $details, $moodLevel, $fileContent); // Changed to 'b' for BLOB

        // Check if the prepared statement was executed successfully
        if ($insertStmt->execute()) {
            echo "New journal entry added successfully!";
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
      }

      $query = "SELECT * FROM Journal WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $patientId);
      $stmt->execute();
      $result = $stmt->get_result();

      $stmt->close();
      $conn->close();
    ?>
    </header>
    <main>
      <div class="container">
        <!-- Left hand side bar for past journal entries-->
        <div class="journal-left-panel">
          <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search entry..." />
            <button type="submit" id="searchJournal">
              <img
                src="../../assets/images/search-interface-symbol.png"
                width="15px"
              />
            </button>
          </div>
          <div id="journal-list">
              <h2>Past Journals</h2>
              <ul>
                  <?php while ($row = $result->fetch_assoc()): ?>
                      <li onclick="showJournalDetails(<?php echo $row['id']; ?>)">
                          <?php echo htmlspecialchars($row['title']); ?> - <?php echo htmlspecialchars($row['dateCreated']); ?>
                      </li>
                  <?php endwhile; ?>
              </ul>
          </div>
       </div>

        <!-- Main panel with journal details -->
        <div class="journal-main-panel">
          <div class="add-new-post">
            <button id="addNewPostBtn" onclick="addnewpost()">New Post</button>
          </div>

          <div id="newJournalModal" class="modal">
            <div class="journal-modal-content">
              <h3 style="color: rgb(161, 50, 149); text-align: center">
                What's on your mind?
                <span class="close">&times;</span>
              </h3>
              <div id="line"></div>
              <form id="new-journal-form" method="POST" action="" enctype="multipart/form-data"> 
              <label for="journalTitle"></label>
              <input
                  type="text"
                  id="journalTitle"
                  name="title"
                  placeholder="Post title"
                  required
              /><br />
              
              <div id="journalDate">
                  <label for="dateCreated">Date:</label>
                  <input
                      type="date"
                      id="dateCreated"
                      name="dateCreated"
                      value="<?php echo date('Y-m-d'); ?>" 
                      required
                  />
              </div>
              
              <div id="journalTime">
                  <label for="timeCreated">Time:</label>
                  <input
                      type="time"
                      id="timeCreated"
                      name="timeCreated"
                      value="<?php echo date('H:i'); ?>" 
                      required
                  />
              </div>
              
              <label for="journalContent"></label>
              <textarea
                  id="journalContent"
                  name="details" 
                  placeholder="Share your thoughts..."
                  rows="10"
                  required
              ></textarea>
              <br />
              
              <div id="fileUpload">
                  <label for="mediaUpload">Upload media:</label>
                  <input type="file" id="mediaUpload" name="mediaUpload" />
              </div>
              <br />
              
              <div id="moodInput" class="moodInput" required>
                  <label for="moodInput">Mood:</label>
                  <input
                      style="order: 10"
                      type="button"
                      id="btn1"
                      class="moodbtn"
                      value="1"
                      onclick="selectMood(1)"
                  />
                  <input
                      style="order: 9"
                      type="button"
                      id="btn2"
                      class="moodbtn"
                      value="2"
                      onclick="selectMood(2)"
                  />
                  <input
                      style="order: 8"
                      type="button"
                      id="btn3"
                      class="moodbtn"
                      value="3"
                      onclick="selectMood(3)"
                  />
                  <input
                      style="order: 7"
                      type="button"
                      id="btn4"
                      class="moodbtn"
                      value="4"
                      onclick="selectMood(4)"
                  />
                  <input
                      style="order: 6"
                      type="button"
                      id="btn5"
                      class="moodbtn"
                      value="5"
                      onclick="selectMood(5)"
                  />
                  <input
                      style="order: 5"
                      type="button"
                      id="btn6"
                      class="moodbtn"
                      value="6"
                      onclick="selectMood(6)"
                  />
                  <input
                      style="order: 4"
                      type="button"
                      id="btn7"
                      class="moodbtn"
                      value="7"
                      onclick="selectMood(7)"
                  />
                  <input
                      style="order: 3"
                      type="button"
                      id="btn8"
                      class="moodbtn"
                      value="8"
                      onclick="selectMood(8)"
                  />
                  <input
                      style="order: 2"
                      type="button"
                      id="btn9"
                      class="moodbtn"
                      value="9"
                      onclick="selectMood(9)"
                  />
                  <input
                      style="order: 1"
                      type="button"
                      id="btn10"
                      class="moodbtn"
                      value="10"
                      onclick="selectMood(10)"
                  />
                  <input type="hidden" name="moodLevel" id="moodLevel" required />
    </div>
    
    <div id="line"></div>
    <input type="submit" value="Publish" />
</form>
            </div>
          </div>

          <div class="journal-details">
            <!-- <h2>Journal Details</h2> -->
            <div id="journalDetails">
            <?php while ($row = $result->fetch_assoc()): ?>
                    <li onclick="showJournalDetails(<?php echo $row['id']; ?>)">
                        <?php echo htmlspecialchars($row['title']); ?> - <?php echo htmlspecialchars($row['dateCreated']); ?>
                    </li>
                <?php endwhile; ?>
            </div>
          </div>
        </div>

        <!-- Right panel -->
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
      </div>
    </main>

    <footer>
    <?php
      include_once ("../footer/patient_footer.php")
      ?>
    </footer>
    
    <script src="../../components/patient/patient.js"></script>
    <script src="../../components/patient/journal.js"></script>
  </body>
</html>
