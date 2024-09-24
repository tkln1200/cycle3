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
      <nav id="shared-header-patient">
      <?php include_once ("../navigation/patient_nav.php")
      ?> 
      </nav>
    </header>
    <main>
      <div class="container">
        <h1>Manage Daily Affirmations</h1>
        <form id="affirmationForm">
          <label for="affirmationInput">Add a New Affirmation:</label>
          <input
            type="text"
            id="affirmationInput"
            name="affirmationInput"
            placeholder="Enter your affirmation"
            required
          />
          <button type="submit">Add Affirmation</button>
        </form>

        <h2>Available Affirmations</h2>
        <ul id="affirmationList">
          <!-- List of affirmations will be populated here -->
        </ul>

        <h2>Select Daily Affirmation</h2>
        <select id="selectAffirmation">
          <!-- Affirmation options will be populated here -->
        </select>
        <button id="setDailyAffirmation">Set as Daily Affirmation</button>
      </div>
    </main>
    <footer>
    <?php
      include_once ("../footer/patient_footer.php")
      ?>
    </footer>
    <script src="../../components/patient/affirmation.js"></script>
  </body>
</html>
