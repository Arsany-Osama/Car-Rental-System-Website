<?php
session_start();
include("connection.php");

// Check if the user is logged in and has an OTP email
if (!isset($_SESSION['otp_email'])) {
    header("Location: index.php"); // Redirect to login if no OTP email found
    exit;
}

$email = $_SESSION['otp_email'];
echo "Email: " . $email;

// Process the form submission
if (isset($_POST['submit'])) {
    $otp = $_POST['otp']; // The OTP entered by the user

    // Retrieve OTP and expiration from the database based on the user's email
    if (isset($_SESSION['admin_data']['role']) && $_SESSION['admin_data']['role'] === 'admin') {
        // Admin OTP verification
        $stmt = $conn->prepare("SELECT otp, otp_expiration FROM admin WHERE email = ?");
    } else {
        // Customer OTP verification
        $stmt = $conn->prepare("SELECT otp, otp_expiration FROM customer WHERE email = ?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedOtp, $otpExpiration);
        $stmt->fetch();

        // Check if OTP is valid and hasn't expired
        if ($otp === $storedOtp && strtotime($otpExpiration) > time()) {
            // OTP is valid, proceed to the correct homepage
            if (isset($_SESSION['admin_data']['role']) && $_SESSION['admin_data']['role'] === 'admin') {
                header("Location: adminHome.php");
            } else {
                header("Location: home.php");
            }
            exit;
        } else {
            // OTP is invalid or expired
            echo '<script>alert("Invalid OTP or OTP expired.");</script>';
        }
    } else {
        echo '<script>alert("Please check your email or log in again.");</script>';
    }
    $stmt->close();
}

// Session timeout check
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 600) { // 10-minute timeout
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
$_SESSION['last_activity'] = time(); // Update last activity time

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify OTP</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <form action="" method="post">
      <h2>Enter OTP</h2>
      <div class="input-field">
        <input type="text" required name="otp" maxlength="6">
        <label>OTP</label>
      </div>
      <button type="submit" name="submit">Verify OTP</button>
    </form>
  </div>
</body>
</html>
