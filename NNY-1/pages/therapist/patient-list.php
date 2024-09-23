<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Therapist Dashboard</title>
    <link rel="stylesheet" href="/assets/css/patient-list.css" />
    <link rel="stylesheet" href="../../assets/css/therapist.css" />
    <link rel="stylesheet" href="/assets/css/shared.css">
  </head>
  <body>
    <header>
      <nav id="shared-header-patient">
        <ul>
          <!-- <li><a href="/pages/patient-list.html">Dashboard</a></li> -->
          <li><a href="/pages/patient-list.html">Patient List</a></li>
          <li><a href="/pages/group-page.html">Group</a></li>
          <li><a href="#">Logout</a></li>
          <li><img src="../assets/images/therapist.jpg" alt="#" /></li>
        </ul>
      </nav>
    </header>
    <div class="main-content">
      <h2>Patient List</h2>
      <div class="content">
        <!-- Create Group Button -->
        <div class="group-search-container">
          <button class="create-group-btn" id="createGroupBtn">Create Group</button>
      
          <!-- Search Box and Button -->
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
              <th>Group</th>
              <th>ID</th>
              <th>Name</th>
              <th>Diagnosis</th>
              <th>Progress</th>
              <th>Status</th>
              <th>View Journal Entries</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="group-page.html">Group 1</a></td>
              <td><a href="patient_profile.html">01</a></td>
              <td>John Anders </td>
              <td>Depression</td>
              <td>33%</td>
              <td>
                <select onchange="changeTableColor(this)">
                  <option>Active</option>
                  <option>Inactive</option>
                  <option>On Hold</option>
                  <option value="follow">Follow-up</option>
                </select>
              </td>
              <td>
                <button
                  class="journal-btn"
                  onclick="location.href='/pages/patient-journal.html'"
                >
                  View
                </button>
              </td>
              <td><input type="checkbox" name="" class="select-patient"></td>
            </tr>
            <tr>
              <td><a href="group-page.html">Group 2</a></td>
              <td><a href="patient_profile.html">02</a></td>
              <td>Zoe Ashford</td>
              <td>Generalized Anxiety Disorder</td>
              <td>7%</td>
              <td>
                <select onchange="changeTableColor(this)">
                  <option>Active</option>
                  <option>Inactive</option>
                  <option>On Hold</option>
                  <option value="follow">Follow-up</option>
                </select>
              </td>
              <td>
                <button
                  class="journal-btn"
                  onclick="location.href='/pages/patient-journal.html'"
                >
                  View
                </button>
              </td>
              <td><input type="checkbox" name="" class="select-patient"></td>
            </tr>
            <tr>
              <td><a href="group-page.html">Group 3</a></td>
              <td><a href="patient_profile.html">03</a></td>
              <td>Emma Harris </td>
              <td>Bipolar Disorder</td>
              <td>98%</td>
              <td>
                <select onchange="changeTableColor(this)">
                  <option>Active</option>
                  <option>Inactive</option>
                  <option>On Hold</option>
                  <option value="follow">Follow-up</option>
                </select>
              </td>
              <td>
                <button
                  class="journal-btn"
                  onclick="location.href='/pages/patient-journal.html'"
                >
                  View
                </button>
              </td>
              <td><input type="checkbox" name="patient" class="select-patient"></td>
            </tr>
            <tr></tr>
              <td><a href="group-page.html">Group 2</a></td>
              <td><a href="patient_profile.html">04</a></td>
              <td>James Foster</td>
              <td>Generalized Anxiety Disorder</td>
              <td>58%</td>
              <td>
                <select onchange="changeTableColor(this)">
                  <option>Active</option>
                  <option>Inactive</option>
                  <option>On Hold</option>
                  <option value="follow">Follow-up</option>
                </select>
              </td>
              <td>
                <button
                  class="journal-btn"
                  onclick="location.href='/pages/patient-journal.html'"
                >
                  View
                </button>
              </td>
              <td><input type="checkbox" name="patient" class="select-patient"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Group Form Modal -->
      <div id="groupFormModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Create Group</h2>
            <form id="groupForm">
                <label for="groupName">Group Name:</label>
                <input type="text" id="groupName" name="groupName" required />
    
                <label for="participants">Participants:</label>
                <input type="text" id="participants" name="participants" readonly />
    
                <label for="availableSpace">Available Space:</label>
                <input type="number" id="availableSpace" name="availableSpace" required />
    
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required />
    
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required />
    
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required />
    
                <button type="submit" class="save-group-btn">Save Group</button>
            </form>
        </div>
    </div>
    </div>
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
    </div>
  
  </div>
    <script src="../../components/therapist/therapist.js"></script>
  </body>
</html>
