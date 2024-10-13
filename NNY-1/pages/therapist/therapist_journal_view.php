<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient Journal</title>
    <link rel="stylesheet" href="../../assets/css/therapist_journal.css" />
    <link rel="stylesheet" href="../../assets/css/shared.css" />
    <script src="../../components/therapist/therapist_journal.js"></script>
  </head>
  <body>
    <header>
    <?php 
      session_start();
      include_once ("../navigation/therapist_nav.php");
      require_once "../patient/patient_journal_connect.php";
           
           
      $therapistId = 5; 

      //Fetching journals for logged in therapist
      $query = "SELECT j.*, p.fname, p.lname 
                FROM Journal j 
                JOIN Patient p ON j.patientId = p.id 
                WHERE j.therapistId = ? 
                ORDER BY j.dateCreated DESC";      
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $therapistId);
      $stmt->execute();
      $result = $stmt->get_result();
      $journals = [];

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $journals[] = $row;
        }
      } 
  
      echo '<script> populateJournalList(' . json_encode($journals) . ');</script>';
  
      //Fetching past journals on calendar
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

    ?>


    </header>
    <main>
      <div class="container">
        <!-- Left hand side bar for past journal entries-->
        <div class="journal-left-panel">
          <div class="search-bar">
            <input 
              type="text" 
              id="searchInput" 
              placeholder="Search entry by patient name..." 
              list="patientNames" 
              value="<?php echo isset($_GET['patientName']) ? htmlspecialchars($_GET['patientName']) : ''; ?>" 
            />
            <datalist id="patientNames">
              <?php           
                // Fetch patient names from the database
                $query = "SELECT fname FROM Patient";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['fname']) . '"></option>';
                }
              ?>
            </datalist>
            
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
          <div class="add-new-note">
            <button id="addNewNoteBtn" onclick="addNewNote()">New Note</button>
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
    <script src="../../components/therapist/therapist_journal.js"></script>
  </body>
</html>
