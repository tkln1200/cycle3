<?php
session_start();
require_once "../../includes/connections.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get email and password from the form
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Prepare and bind
  $stmt = $conn->prepare("SELECT id, password FROM therapist WHERE email = ?");
  $stmt->bind_param("s", $email);
  
  // Execute the query
  $stmt->execute();
  
  // Store the result
  $stmt->store_result();

  // Check if email exists
  if ($stmt->num_rows > 0) {
      // Bind result variables
      $stmt->bind_result($id, $hashed_password);
      $stmt->fetch();

      // Verify the password
      if (password_verify($password, $hashed_password)) {
          // Password is correct, start session and redirect
          $_SESSION['therapist_id'] = $id;
          header("Location: ../therapist/patient_list.php"); // Redirect therapist's patient list
          exit();
      } else {
          // Password is incorrect
          $error = "Invalid password.";
      }
  } else {
      // Email not found
      $error = "No account found with that email.";
  }
  
  // Close statement
  $stmt->close();
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
        <form action="" method="post">
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
