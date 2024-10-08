<?php
  session_start();
  include_once '../../includes/connections.php';

  if (empty($_SESSION['therapist_id'])) 
  {
    $therapist_id = 1;
  }
  else
  {
    $therapist_id = $_SESSION['therapist_id'];
  }
  $current_date = date('Y-m-d');
  $current_time = date('H:i:s');
  $sql_search_groups_past = "SELECT * FROM groups WHERE therapist_id = '$therapist_id' AND (date < '$current_date' 
         OR (date = '$current_date' AND sTime < '$current_time'))";
  $sql_search_groups_new = "SELECT * FROM groups WHERE therapist_id = '$therapist_id' AND (date > '$current_date' 
         OR (date = '$current_date' AND sTime > '$current_time'))";

  $sql_obj_past =  mysqli_query($conn,$sql_search_groups_past) Or die("Failed to query " . mysqli_error($conn));
  $sql_obj_new =  mysqli_query($conn,$sql_search_groups_new) Or die("Failed to query " . mysqli_error($conn));


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Group Therapy Sessions</title>
    <link rel="stylesheet" href="../../assets/css/group-page.css" />
    <link rel="stylesheet" href="../../assets/css/shared.css" />
  </head>
  <body>
    <header>
    <?php include_once ("../navigation/therapist_nav.php")
    ?> 
    </header>
    <main>
      <section class="group-container">
        <h1>Group Therapy Sessions</h1>
        <div class="group-list">
          <h2>Latest Group Session</h2>
          <?php
            if(mysqli_num_rows($sql_obj_new)>0)
            {
              while ($row = mysqli_fetch_assoc($sql_obj_new))
              {
                echo '<div class="group-card latest-session">
                        <h3>Group Name: ' .$row['group_name'] .'</h3>
                        <p><strong>Date:</strong> '. $row['date'] . '</p>
                        <p><strong>Time:</strong> ' .  $row['sTime'] . '-' . $row['eTime'] . '</p>
                        <p><strong>Location:</strong> '. $row['location'] .'</p>
                        <p><strong>Participants:</strong> '. $row['participants'] . '</p>
                        <p><strong>Available Space:</strong> '. $row['space'] - $row['occupied_space'] . '</p>
                      </div>';
              }
            }
          ?>


          <h2>Previous Sessions</h2>
          <?php
            if(mysqli_num_rows($sql_obj_past)>0)
            {
              while ($row1 = mysqli_fetch_assoc($sql_obj_past))
              {
                echo '<div class="group-card">
                        <h3>Group Name: ' .$row1['group_name'] .'</h3>
                        <p><strong>Date:</strong> '. $row1['date'] . '</p>
                        <p><strong>Time:</strong> ' .  $row1['sTime'] . '-' . $row1['eTime'] . '</p>
                        <p><strong>Location:</strong> '. $row1['location'] .'</p>
                        <p><strong>Participants:</strong> '. $row1['participants'] . '</p>
                        <p><strong>Available Space:</strong> '. $row1['space'] - $row1['occupied_space'] . '</p>
                      </div>';
              }
            }
          ?>


        </div>
      </section>
    </main>

    <footer>
    <?php include_once ("../footer/therapist_footer.php")
    ?> 
    </footer>
  </body>
</html>
