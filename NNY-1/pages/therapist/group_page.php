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
          <div class="group-card latest-session">
            <h3>Group Name: Coping with Anxiety</h3>
            <p><strong>Date:</strong> September 25, 2024</p>
            <p><strong>Time:</strong> 10:00 AM - 11:30 AM</p>
            <p><strong>Location:</strong> Room A1</p>
            <p><strong>Participants:</strong> Zoe Ashford, James Foster</p>
            <p><strong>Available Space:</strong> 2/5</p>
            <button class="details-btn">View Details</button>
          </div>

          <h2>Previous Sessions</h2>
          <div class="group-card">
            <h3>Group Name: Depression Management</h3>
            <p><strong>Date:</strong> September 15, 2024</p>
            <p><strong>Time:</strong> 9:00 AM - 10:30 AM</p>
            <p><strong>Location:</strong> Room B2</p>
            <p><strong>Participants:</strong> Minho, John Snow</p>
            <p><strong>Available Space:</strong> 3/5</p>
            <button class="details-btn">View Details</button>
          </div>

          <div class="group-card">
            <h3>Group Name: Mindfulness and Stress Relief</h3>
            <p><strong>Date:</strong> August 28, 2024</p>
            <p><strong>Time:</strong> 11:00 AM - 12:30 PM</p>
            <p><strong>Location:</strong> Room C1</p>
            <p><strong>Participants:</strong> Minho, John Snow, Luffy</p>
            <p><strong>Available Space:</strong> 1/5</p>
            <button class="details-btn">View Details</button>
          </div>
        </div>
      </section>
    </main>

    <footer>
    <?php include_once ("../footer/therapist_footer.php")
    ?> 
    </footer>
  </body>
</html>
