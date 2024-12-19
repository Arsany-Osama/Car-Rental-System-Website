<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Login Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <form action="" method="post" >
      <h2>Login</h2>
      <div class="input-field">
      <input type="email" required name="email">
      <label>Email</label>
      </div>
      <div class="input-field">
      <input type="password" required name="pass">
      <label>Password</label>
      </div>
      <div class="forget">
        </label>
      </div>
      <button type="submit" name="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
<?php
  session_start();
  include("connection.php");

  if (isset($_POST['submit'])) {
      if ($conn->connect_error) {
          die("something wrong , please comeback later" . $conn->connect_error);
      }

      // Sanitize and validate email
      $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<script>alert("Invalid email format.");</script>';
          exit;
      }

      // Get the plain text password
      $pass = trim($_POST["pass"]);

      // Check if the user is an admin
      $stmt = $conn->prepare("SELECT password FROM admin WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          $stmt->bind_result($hashedPassword);
          $stmt->fetch();
          
          if (password_verify($pass, $hashedPassword)) {
              // Admin login success
              header("Location: adminHome.php");
              exit;
          }
      }
      $stmt->close();

      // Check if the user is a customer
      $stmt = $conn->prepare("SELECT cssn, email, cpass , fname , lname FROM customer WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $hashedPassword = $row['cpass'];
        
          if (password_verify($pass, $hashedPassword)) {
              // Store user data in session
              $_SESSION['user_data'] = [
                  'cssn' => $row['cssn'],
                  'email' => $row['email'],
                  'fname' => $row['fname'],
                  'lname' => $row['lname']
              ];

              // Customer login success
              header("Location: home.php");
              exit;
          }
      }

      // If login fails
      echo '<script>alert("Invalid Email or Password.");</script>';
      $stmt->close();
  }

  $conn->close();
?>
