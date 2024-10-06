<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Journal</title>
    <link rel="stylesheet" href="../../assets/css/patient.css" />
    <link rel="stylesheet" href="../../assets/css/shared.css" />
    <script src="../../components/patient/patient.js"></script>
    <script src="../../components/patient/journal.js"></script>
  </head>
  <body>
    <header>
    <?php 
      session_start();
      include_once ("../navigation/patient_nav.php");
      require_once "patient_journal_connect.php";
      require_once "patient_dashboard_connect.php";
      
      if (!isset($_SESSION['patientId'])) {
        header("Location: ../login/patient_login.php");
        exit();
      }
      
      $patientId = $_SESSION['patientId'];
      
      $query = "SELECT * FROM Journal WHERE patientId = ? ORDER BY dateCreated DESC";      
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
  
      echo '<script> populateJournalList(' . json_encode($journals) . ');</script>';
    
      $query = "SELECT therapistId FROM Patient WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $patientId);
      $stmt->execute();
      $result = $stmt->get_result();
      $therapistId = null;

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $therapistId = $row['therapistId']; 
      }    

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $dateCreated = $_POST['dateCreated'];
        $timeCreated = $_POST['timeCreated'];
        $details = $_POST['details'];
        $moodLevel = $_POST['moodLevel'];
        
        $uploadDir = "uploads/";

        // Check if the uploads directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory with appropriate permissions
        }
        // Initialize mediaName
        $mediaName = null;
    
        // Check if a file was uploaded
        if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] == UPLOAD_ERR_OK) {
            $mediaName = $_FILES['mediaUpload']['name'];
            $mediaTmpName = $_FILES['mediaUpload']['tmp_name'];
            $mediaDestination = "uploads/" . basename($mediaName); // Ensure this directory exists
    
            // Move the uploaded file to the desired directory
            if (!move_uploaded_file($mediaTmpName, $mediaDestination)) {
                echo "Error uploading media.";
            }
        }

        $insertQuery = "INSERT INTO Journal (patientId, therapistId, title, dateCreated, timeCreated, details, moodLevel, file) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
    
        $insertStmt->bind_param("iissssib", $patientId, $therapistId, $title, $dateCreated, $timeCreated, $details, $moodLevel, $mediaName);
    
        if ($insertStmt->execute()) {
          header("Location: patient_journal.php");
          exit();
        } 
        
        else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
        
        $query = "SELECT * FROM Journal WHERE patientId = ? ORDER BY dateCreated DESC";      
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
  
        $conn->close();
  
      }
    ?>


    </header>
    <main>
      <div class="container">
        <!-- Left hand side bar for past journal entries-->
        <div class="journal-left-panel">
          <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search entry by title..." />
            <button type="submit" id="searchJournal" onclick="filterJournals()">
              <img
                src="../../assets/images/search-interface-symbol.png"
                width="15px"
              />
            </button>
          </div>
          
          <div id="journalList" class="journalList"> 
        
          </div>
        
       </div>

        <!-- Main panel with journal details -->
        <div class="journal-main-panel">
          <div class="add-new-post">
            <button id="addNewPostBtn" onclick="addnewpost()">New Post</button>
          </div>

          <div id="newJournalModal" class="modal">
            <div class="journal-modal-content">
              <h3 style="color: rgb(161, 50, 149); text-align: center; size: medium">
                What's on your mind?
                <span class="close">&times;</span>
              </h3>
              <div id="line"></div>
              <form id="journalForm" method="POST" action="patient_journal.php" enctype="multipart/form-data"> 
              <label for="journalTitle"></label>
              <input
                  type="text"
                  id="journalTitle"
                  name="title"
                  placeholder="Post title"
                  required
              /><br />
              
              <div id="journalDate">
                  <label for="dateCreated"></label>
                  <input
                      type="date"
                      id="dateCreated"
                      name="dateCreated"
                      value="<?php echo date('Y-m-d'); ?>" 
                      required
                  />
              </div>
              
              <div id="journalTime">
                  <label for="timeCreated"></label>
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
                  id="details"
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
              
              <!-- <div id="moodInput" class="moodInput" required>
                <label for="moodLevel">Mood:</label>
                <input type="button" id="btn1" class="moodbtn" value="1" />
                <input type="button" id="btn2" class="moodbtn" value="2" />
                <input type="button" id="btn3" class="moodbtn" value="3" />
                <input type="button" id="btn4" class="moodbtn" value="4" />
                <input type="button" id="btn5" class="moodbtn" value="5" />
                <input type="button" id="btn6" class="moodbtn" value="6" />
                <input type="button" id="btn7" class="moodbtn" value="7" />
                <input type="button" id="btn8" class="moodbtn" value="8" />
                <input type="button" id="btn9" class="moodbtn" value="9" />
                <input type="button" id="btn10" class="moodbtn" value="10" />
                <input type="hidden" name="moodLevel" id="moodLevel" required />
              </div> -->

              <div id="moodInput" required>
              <label for="moodLevel">Mood Level (from 1 to 10):</label>
              <input type="number" id="moodLevel" class="moodLvel" name="moodLevel" value="1" min="1" max="10" />
              </div>
                             
              <div id="line"></div>
                  <input type="submit" value="Publish" />
              </div>  
            </form>
          </div>
        

          <div class="journal-details">
            <h2 style="color: rgb(161, 50, 149);">Journal Details</h2>
            
            <div id="journalDetails">
            <!-- JS generated details -->
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
          
          <div class="chart-container">
            <h2>Recent Activity - Mood Level</h2>
            <canvas id="lineChart" width="500" height="150"></canvas>
          </div>
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
