<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Activity Tracker</title>
    <link rel="stylesheet" href="../../assets/css/shared.css" />
    <link rel="stylesheet" href="../../assets/css/patient.css" />
    <link rel="stylesheet" href="../../assets/css/activity-tracker.css" />
  </head>
  <body>
    <header>
      <nav id="shared-header-patient">
      <?php include_once ("../navigation/patient_nav.php")
      ?> 
      </nav>
    </header>
    <main class="activity-tracker-main">
      <h2>Activity Tracker</h2>
      <form id="activity-tracker-form" class="activity-tracker-form">
        <section id="sleeping-cycles" class="activity-tracker-section">
          <h3>Record Sleeping Cycles</h3>
          <div class="form-group">
            <label for="sleep-date">Date:</label>
            <input type="date" id="sleep-date" name="sleep-date" required />
          </div>
          <div class="form-group">
            <label for="sleep-duration">Duration (hours):</label>
            <input
              type="number"
              id="sleep-duration"
              name="sleep-duration"
              min="0"
              required
            />
          </div>
          <div class="form-group">
            <label for="sleep-quality">Quality:</label>
            <select id="sleep-quality" name="sleep-quality" required>
              <option value="excellent">Excellent</option>
              <option value="good">Good</option>
              <option value="average">Average</option>
              <option value="poor">Poor</option>
            </select>
          </div>
        </section>

        <section
          id="eating-habits"
          class="activity-tracker-section vertical-layout"
        >
          <h3>Record Eating Habits</h3>
          <div class="form-group">
            <label for="meal-date">Date:</label>
            <input type="date" id="meal-date" name="meal-date" required />
          </div>
          <div class="form-group">
            <label for="meal-type">Meal Type:</label>
            <select id="meal-type" name="meal-type" required>
              <option value="breakfast">Breakfast</option>
              <option value="lunch">Lunch</option>
              <option value="dinner">Dinner</option>
              <option value="snack">Snack</option>
            </select>
          </div>
          <div class="form-group">
            <label for="meal-description">Description:</label>
            <textarea
              id="meal-description"
              name="meal-description"
              required
            ></textarea>
          </div>
        </section>

        <section id="exercise" class="activity-tracker-section">
          <h3>Record Exercise</h3>
          <div class="form-group">
            <label for="exercise-date">Date:</label>
            <input
              type="date"
              id="exercise-date"
              name="exercise-date"
              required
            />
          </div>
          <div class="form-group">
            <label for="exercise-type">Exercise Type:</label>
            <input
              type="text"
              id="exercise-type"
              name="exercise-type"
              required
            />
          </div>
          <div class="form-group">
            <label for="exercise-duration">Duration (minutes):</label>
            <input
              type="number"
              id="exercise-duration"
              name="exercise-duration"
              min="0"
              required
            />
          </div>
        </section>

        <button type="submit">Submit All Records</button>
      </form>
    </main>
    <footer>
    <?php
      include_once ("../footer/patient_footer.php")
      ?>
    </footer>
    <script src="activity-tracker.js"></script>
  </body>
</html>
