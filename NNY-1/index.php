<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/log-in.css" />
    <!-- Global CSS -->
  </head>
  <body>
    <div class="login-container">
      <div class="login-options">
        <button
          onclick="window.location.href='./pages/login/patient_login.php'"
        >
          Login as a Patient
        </button>
        <button
          onclick="window.location.href='./pages/login/therapist_login.php'"
        >
          Login as a Therapist
        </button>
        <button
          onclick="window.location.href='./pages/login/auditor_login.php'"
        >
          Login as an Auditor
        </button>
        <button onclick="window.location.href='./pages/login/staff_login.php'">
          Login as a Staff
        </button>
      </div>
    </div>
    <div class="login-image"></div>
  </body>
</html>
