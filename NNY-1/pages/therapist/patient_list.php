<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Therapist Dashboard</title>
  <link rel="stylesheet" href="../../assets/css/patient-list.css" />
  <link rel="stylesheet" href="../../assets/css/therapist.css" />
  <link rel="stylesheet" href="../../assets/css/shared.css">
</head>

<body>
  <header>
    <?php
    include_once("../navigation/therapist_nav.php");

    require_once "../patient/patient-dashboard-connect.php";

    // Query to fetch all patients
    $sql = "SELECT id, fName, lName, dob, gender, contactNo, diagnosis, status FROM Patient";
    $result = $conn->query($sql);

    $patients = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
      }
    } else {
      echo "No patients found.";
    }
    $conn->close();
    ?>

  </header>
  <div class="main-content">
    <h2>Patient List</h2>
    <div class="content">
      <div class="group-search-container">
        <button class="create-group-btn" id="createGroupBtn">Create Group</button>
        <div class="search-container">
          <form action="#" method="post" class="search-form">
            <input type="text" placeholder="Search..." id="search-input" />
            <button type="submit" class="search-btn">Search</button>
          </form>
        </div>
      </div>
      <table id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Phone Number</th>
            <th>Diagnosis</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($patients)): ?>
            <?php foreach ($patients as $patient): ?>
              <tr>
                <td><a href="patient_profile.php?id=<?php echo htmlspecialchars($patient['id']); ?>"><?php echo htmlspecialchars($patient['id']); ?></a></td>
                <td><?php echo htmlspecialchars($patient['fName'] . " " . $patient['lName']); ?></td>
                <td><?php echo htmlspecialchars($patient['gender']); ?></td>
                <td><?php echo htmlspecialchars($patient['dob']); ?></td>
                <td><?php echo htmlspecialchars($patient['contactNo']); ?></td>
                <td><?php echo htmlspecialchars($patient['diagnosis']); ?></td>
                <td><?php echo htmlspecialchars($patient['status']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="16">No patients found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <footer>
      <?php include_once("../footer/therapist_footer.php") ?>
    </footer>
  </div>
  <script src="../../components/therapist/therapist.js"></script>
</body>

</html>