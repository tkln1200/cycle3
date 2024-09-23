<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Group Therapy Sessions</title>
    <link rel="stylesheet" href="/assets/css/group-page.css" />
    <link rel="stylesheet" href="/assets/css/shared.css" />
  </head>
  <body>
    <header>
      <nav id="shared-header-patient">
        <ul>
          <!-- <li><a href="/pages/patient-list.html">Dashboard</a></li> -->
          <li><a href="/pages/patient-list.html">Patient List</a></li>
          <li><a href="/pages/group-page.html">Group</a></li>
          <li><a href="#">Logout</a></li>
          <li><img src="/assets/images/therapist.jpg" alt="#" /></li>
        </ul>
      </nav>
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
      <div class="footer-container">
        <div class="footer-section">
          <p>Patient Management</p>
          <ul>
            <li><a href="#">Paitient List</a></li>
            <li><a href="#">Paitient Detail</a></li>
            <li><a href="#">Communication</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <p>Group Management</p>
          <ul>
            <li><a href="#">Group Overview</a></li>
            <li><a href="#">Create Group</a></li>
            <li><a href="#">Group Schedule</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <p>Dashboard</p>
          <ul>
            <li><a href="#">Patient Tracking</a></li>
            <li><a href="#">Group Session Tracking</a></li>
            <li><a href="#">Compliance and Documentation</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <p>Setting</p>
          <ul>
            <li><a href="#">Profile Settings</a></li>
            <li><a href="#">Data Privacy</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <p>Support</p>
          <ul>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Contact Support</a></li>
            <li><a href="#">User Guide</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright">
        <p>Copyright &copy; 2024 Flinders University. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
