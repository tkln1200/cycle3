<?php
session_start();
require_once "./login_connect.php"; // Update to your actual database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT therapistId, password FROM therapist WHERE email = ?";
  $stmt = $conn->prepare($sql);

  if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  // Verify if a user with the given email exists
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($therapistID, $hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
      // Password is correct, start the session
      $_SESSION['therapistId'] = $therapistId;
      $_SESSION['email'] = $email;

      // Redirect to patient database
      header("Location: ../therapist/patient_list.php");
      exit();
    } else {
      echo "<script>alert('Invalid password. Please try again.');</script>";
    }
  } else {
    echo "<script>alert('No user found with this email. Please try again.');</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Therapist Login</title>
    <link rel="stylesheet" href="../../assets/css/log-in.css" />
  </head>
  <body>
    <div class="login-container">
      <div class="login-box">
        <h2>Login as a Therapist</h2>
        <form action="../therapist/patient_list.php" method="post">
          <div class="input-group">
            <input type="email" name="email" placeholder="Email" required />
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
