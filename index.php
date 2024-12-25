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
      $stmt = $conn->prepare("SELECT id,password FROM admin WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          $stmt->bind_result($adminId, $adminPassword);
          $stmt->fetch();

     if ($pass === $adminPassword) {
         // Store admin data in session
        $_SESSION['admin_data'] = [
            'id' => $adminId,
            'role' => 'admin'  // Add admin role to the session
        ];
        // Generate OTP and store it in the database
        $otp = rand(100000, 999999); // 6-digit OTP
        $otpExpiration = date("Y-m-d H:i:s", strtotime('+5 minutes'));

        // Update OTP and expiration time in the database for admin
        $stmt = $conn->prepare("UPDATE admin SET otp = ?, otp_expiration = ? WHERE email = ?");
        $stmt->bind_param("sss", $otp, $otpExpiration, $email);
        $stmt->execute();

        // Send OTP to admin's email (simplified version)
        mail($email, "Your OTP Code", "Your OTP code is: $otp");

        // Redirect to OTP verification page
        $_SESSION['otp_email'] = $email; // Store the email for OTP verification
        header("Location: verify_otp.php");
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
                  'lname' => $row['lname'],
                  'role' => 'customer'  // Add customer role to the session
              ];


              // Generate OTP and store it in the database
            $otp = rand(100000, 999999); // 6-digit OTP
            $otpExpiration = date("Y-m-d H:i:s", strtotime('+5 minutes'));

            // Update OTP and expiration time in the database for customer
            $stmt = $conn->prepare("UPDATE customer SET otp = ?, otp_expiration = ? WHERE email = ?");
            $stmt->bind_param("sss", $otp, $otpExpiration, $email);
            $stmt->execute();

            // Send OTP to customer's email (simplified version)
            mail($email, "Your OTP Code", "Your OTP code is: $otp");

            // Redirect to OTP verification page
            $_SESSION['otp_email'] = $email; // Store the email for OTP verification
            header("Location: verify_otp.php");
            exit;
          }
      }

      // If login fails
      echo '<script>alert("Invalid Email or Password.");</script>';
      $stmt->close();
  }

  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 600) { // 10-minute timeout
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
$_SESSION['last_activity'] = time(); // Update last activity time


  $conn->close();
?>
