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
    // if (!isset($_SESSION['patientId'])) {
    //   // Redirect to login page if the patient is not logged in
    //   header("Location: ../login/patient_login.php");
    //   exit();
    // }
      $patientId = $_SESSION['patientId'];
      $query = "SELECT id, title, dateCreated, timeCreated, details, moodLevel, file FROM Journal WHERE id = ?";
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
          <div class="journalList">
            <!-- <h2>Past Journal</h2> -->
            <div id="journalList">
              <!-- JavaScript will populate this list dynamically -->
            </div>
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

              <form id="journalForm">
                <label for="journalTitle"></label>
                <input
                  type="title"
                  id="journalTitle"
                  name="title"
                  placeholder="Post title"
                  required
                /><br />
                <div id="journalDate"></div>
                <div id="journalTime"></div>
                <label for="journalContent"></label>
                <textarea
                  id="journalContent"
                  name="content"
                  placeholder="Share your thoughts.."
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
                  />
                  <input
                    style="order: 9"
                    type="button"
                    id="btn2"
                    class="moodbtn"
                    value="2"
                  />
                  <input
                    style="order: 8"
                    type="button"
                    id="btn3"
                    class="moodbtn"
                    value="3"
                  />
                  <input
                    style="order: 7"
                    type="button"
                    id="btn4"
                    class="moodbtn"
                    value="4"
                  />
                  <input
                    style="order: 6"
                    type="button"
                    id="btn5"
                    class="moodbtn"
                    value="5"
                  />
                  <input
                    style="order: 5"
                    type="button"
                    id="btn6"
                    class="moodbtn"
                    value="6"
                  />
                  <input
                    style="order: 4"
                    type="button"
                    id="btn7"
                    class="moodbtn"
                    value="7"
                  />
                  <input
                    style="order: 3"
                    type="button"
                    id="btn8"
                    class="moodbtn"
                    value="8"
                  />
                  <input
                    style="order: 2"
                    type="button"
                    id="btn9"
                    class="moodbtn"
                    value="9"
                  />
                  <input
                    style="order: 1"
                    type="button"
                    id="btn10"
                    class="moodbtn"
                    value="10"
                  />
                </div>
                <div id="line"></div>
                <input type="submit" value="Publish" />
              </form>
            </div>
          </div>

          <div class="journal-details">
            <!-- <h2>Journal Details</h2> -->
            <div id="journalDetails">
              <!-- JavaScript will populate this area dynamically -->
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
