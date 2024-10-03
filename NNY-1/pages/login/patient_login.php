<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient Login</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/log-in.css" />
  </head>
  <body>
    <header>
      <?php
      session_start();
      require_once "login_connect.php";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
      
        $query = "SELECT id, password FROM Patient WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $patient = $result->fetch_assoc();
            $stored_password = $patient['password'];  // The stored plain-text password in the database
            // Direct comparison of plain-text passwords (not recommended)
            if ($password === $stored_password) {
                // Password is correct; proceed with login
                $_SESSION['patientId'] = $patient['id'];
                header("Location: ../patient/patient_dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No patient found with that email.";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
      }
      ?>
    </header>
    <div class="login-container">
      <div class="login-box">
        <h2>Login as a Patient</h2>
        <form action="../patient/patient_dashboard.php" method="POST">
          <div class="input-group">
            <input type="email" name="email" placeholder="Email" />
          </div>
          <div class="input-group">
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <span class="toggle-password">👁️</span>
          </div>
          <div class="options">
            <label><input type="checkbox" /> Remember me</label>
            <a href="#">Forgot Password?</a>
          </div>
          <button>Login</button>
          <div class="divider"><span>OR</span></div>
          <div class="google-login">Login with Google</div>
          <div class="register-link">
            Don't have an account? <a href="#">Register</a>
          </div>
        </form>
      </div>
    </div>
    <div class="login-image"></div>
  </body>
</html>
