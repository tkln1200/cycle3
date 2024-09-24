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
        <form action="../therapist/patient-list.php" method="get">
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
