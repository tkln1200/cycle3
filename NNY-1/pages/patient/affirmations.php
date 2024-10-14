<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Affirmations</title>
  <link rel="stylesheet" href="../../assets/css/shared.css" />
  <link rel="stylesheet" href="../../assets/css/affirmation.css" />
</head>

<body>
  <header>
    <?php
    require_once "../../includes/connections.php";

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['affirmationInput'])) {
      $affirmation = $_POST['affirmationInput'];
      $stmt = $conn->prepare("INSERT INTO affirmation (description) VALUES (?)");
      $stmt->bind_param("s", $affirmation);
      if ($stmt->execute()) {
        echo "<script>alert('Affirmation added successfully!');</script>";
      } else {
        echo "<script>alert('Error adding affirmation.');</script>";
      }
      $stmt->close();
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    }

    // Handle form submission to update the isSelected field
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedAffirmations'])) {
      // Reset all affirmations' isSelected to 0
      $conn->query("UPDATE affirmation SET isSelected = 0");

      // Get selected affirmations from the form
      $selectedAffirmations = $_POST['selectedAffirmations'];

      // Update the selected affirmations to set isSelected = 1
      foreach ($selectedAffirmations as $affirmation) {
        $stmt = $conn->prepare("UPDATE affirmation SET isSelected = 1 WHERE description = ?");
        $stmt->bind_param("s", $affirmation);
        $stmt->execute();
        $stmt->close();
      }

      echo "<script>alert('Affirmations updated successfully!');</script>";
    }
    ?>
    <nav id="shared-header-patient">
      <?php include_once("../navigation/patient_nav.php") ?>
    </nav>
  </header>

  <main>
    <div class="container">
      <h1>Manage Daily Affirmations</h1>

      <form id="affirmationForm" method="POST" action="">
        <label for="affirmationInput">Add a New Affirmation:</label>
        <input type="text" id="affirmationInput" name="affirmationInput" placeholder="Enter your affirmation" required />
        <button type="submit">Add Affirmation</button>
      </form>

      <h2>Available Affirmations</h2>
      <ul id="affirmationList">
        <?php
        $sql = "SELECT * FROM affirmation";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<li>' . htmlspecialchars($row['description']) . '</li>';
          }
        } else {
          echo '<li>No affirmations found.</li>';
        }
        ?>
      </ul>

      <h2>Select Daily Affirmations</h2>
      <div class="dropdown" id="selectAffirmation">
        <span class="dropdown-btn">Select affirmations</span>
        <div class="dropdown-content" id="affirmationDropdown">
          <form id="affirmationsForm" method="POST" action="">
            <?php
            $sql = "SELECT * FROM affirmation";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<label><input type="checkbox" name="selectedAffirmations[]" value="' . htmlspecialchars($row['description']) . '"> ' . htmlspecialchars($row['description']) . '</label>';
              }
            } else {
              echo '<label>No affirmations found.</label>';
            }

            $conn->close();
            ?>
            <button class="custom-select-btn" id="setAffirmationsBtn">Set Affirmations</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <?php include_once("../footer/patient_footer.php") ?>
  </footer>
  <script src="../../components/patient/affirmation.js"></script>

</body>

</html>