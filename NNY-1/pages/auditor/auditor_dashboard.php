<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Consultation Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/auditor.css">
    <link rel="stylesheet" href="../../assets/css/shared.css">
    <link rel="stylesheet" href="../../styles/staff_page.css">
</head>

<body>
    <header>
        <?php
        include_once("../navigation/auditor_nav.php");
        ?>
    </header>
    <div class="dashboard">
        <?php
        
        require_once "../../includes/connections.php";

        // Set pagination variables
        $records_per_page = 10;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $records_per_page;

        // Query to get the total number of records
        $totalRecordsQuery = "SELECT COUNT(DISTINCT p.id) AS total_records FROM Patient p";
        $total_records = $conn->query($totalRecordsQuery)->fetch_assoc()['total_records'];
        $total_pages = ceil($total_records / $records_per_page);

        // Query to get therapist details along with patient count and consultation length with pagination
        $query = "
        SELECT 
            t.fName AS therapist_fname,
            t.lName AS therapist_lname,
            p.fName AS patient_fname,
            p.lName AS patient_lname,
            p.diagnosis,
            DATEDIFF(p.endDate, p.startDate) AS consult_length
        FROM Therapist t
        LEFT JOIN Patient p ON t.id = p.therapistId
        GROUP BY t.id, p.id
        ORDER BY t.fName, t.lName
        LIMIT $records_per_page OFFSET $offset
        ";

        $result = $conn->query($query);

        // Query to get the number of patients treated by each therapist
        $therapistPatientCountQuery = "
        SELECT 
            t.fName AS therapist_fname,
            t.lName AS therapist_lname,
            COUNT(p.id) AS patient_count
        FROM Therapist t
        LEFT JOIN Patient p ON t.id = p.therapistId
        GROUP BY t.id
        ";
        $therapistPatientCountResult = $conn->query($therapistPatientCountQuery);
        ?>

        <div class="stats-container">
            <div class="stat">
                <h4>Appointments</h4>
                <p><?php echo $total_records; ?></p>
            </div>
            <div class="stat">
                <h4>Consult Length</h4>
                <p><?php
                    $consultLengthQuery = "SELECT SUM(DATEDIFF(endDate, startDate)) AS total_consult_length FROM Patient WHERE endDate IS NOT NULL";
                    $consultLength = $conn->query($consultLengthQuery)->fetch_assoc()['total_consult_length'];
                    echo $consultLength . ' hrs';
                    ?></p>
            </div>
            <div class="stat">
                <h4>Patients</h4>
                <p><?php echo $total_records; ?></p>
            </div>
            <div class="stat">
                <h4>Doctors</h4>
                <p><?php echo $therapistCount = $conn->query("SELECT COUNT(*) AS therapist_count FROM Therapist")->fetch_assoc()['therapist_count']; ?></p>
            </div>
        </div>

        <div class="container-flex">
            <!-- Main Table with Pagination (3/4 width) -->
            <div class="table-container main-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Therapist Name</th>
                            <th>Patient Name</th>
                            <th>Diagnosis</th>
                            <th>Consult Length (hrs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['therapist_fname'] . " " . $row['therapist_lname'] . "</td>
                                    <td>" . $row['patient_fname'] . " " . $row['patient_lname'] . "</td>
                                    <td>" . $row['diagnosis'] . "</td>
                                    <td>" . $row['consult_length'] . "</td>
                                  </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                    <?php endif; ?>
                    
                    <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                        <a href="?page=<?php echo $page; ?>" 
                           class="<?php if ($page == $current_page) echo 'active'; ?>">
                           <?php echo $page; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Summary Table (1/4 width) -->
            <div class="table-container summary-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Therapist Name</th>
                            <th>Patient Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($therapistPatientCountResult->num_rows > 0) {
                            while ($row = $therapistPatientCountResult->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['therapist_fname'] . " " . $row['therapist_lname'] . "</td>
                                    <td>" . $row['patient_count'] . "</td>
                                  </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No data available</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../../assets/js/auditor.js"></script>
</body>

</html>
