<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <form action="" method="post" onsubmit="return validatePassword()">
      <h2>Register</h2>
      <div class="input-field">
        <input type="text" required name="ssn" pattern="\d{9}" title="SSN must be 9 digits">
        <label>SSN</label>
      </div>

      <div class="input-field">
        <input type="email" required name="email">
        <label>Email</label>
      </div>

      <div class="input-field">
        <input type="text" required name="fname">
        <label>First Name</label>
      </div>

      <div class="input-field">
        <input type="text" required name="lname">
        <label>Last Name</label>
      </div>

      <div class="input-field">
        <input id="pass" type="password" required name="password">
        <label>Enter your password</label>
        <h6 id="passAlert"></h6>
      </div>

      <div class="input-field">
        <input id="conPass" type="password" required name="cpassword">
        <label>Confirm your password</label>
        <h6 id="confPassAlert"></h6>
      </div>

      <div class="input-field">
        <input type="date" required name="date">
      </div>

      <button type="submit" name="submit">Sign up</button>
      <div class="register">
        <p>Already have an account? <a href="index.php">Login</a></p>
      </div>
    </form>
  </div>
</body>
<script src="validate.js"></script>
</html>

<?php
  if (isset($_POST['submit'])) {
      include("connection.php");

      // Check connection
      if ($conn->connect_error) {
          error_log("Database connection error: " . $conn->connect_error);
          die("An unexpected error occurred. Please try again later.");
      }

      // filter_var() function explained
      // fliter_var(variable , filter)
      
      // variable: The data to validate or sanitize.

      // filter: A predefined filter
      // common filters
      // FILTER_SANITIZE_STRING (deprecated): Removes HTML tags and encodes special characters.
      // FILTER_SANITIZE_EMAIL: Removes illegal characters from an email address.
      // FILTER_VALIDATE_EMAIL: Validates whether the input is a properly formatted email.
      // FILTER_SANITIZE_NUMBER_INT: Removes all characters except digits, +, and -.
      $ssn = filter_var($_POST["ssn"], FILTER_SANITIZE_NUMBER_INT);
      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

      // htmlspecialchars(string, flags, encoding, double_encode)
      // The htmlspecialchars() function converts special characters into HTML entities.
      // This is mainly used to prevent Cross-Site Scripting (XSS)
      // string: The input string to be converted.
      // Common Characters Escaped: < becomes &lt; , > becomes &gt; , & becomes &amp; , " becomes &quot; , ' becomes &#039;
      // Example:
      // $input = "<script>alert('XSS');</script>";
      // $safe_input = htmlspecialchars($input);
      // Output: "&lt;script&gt;alert('XSS');&lt;/script&gt;"
      // The trim() function removes whitespace or specific characters from the beginning and end of a string.
      $fname = htmlspecialchars(trim($_POST["fname"]));
      $lname = htmlspecialchars(trim($_POST["lname"]));
      $pass = $_POST["password"];
      $cpass = $_POST["cpassword"];
      $date = $_POST["date"];

      // Validate email format
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<script>alert("Invalid email format.")</script>';
          exit;
      }

      // Validate password match
      if ($pass !== $cpass) {
          echo '<script>alert("Passwords do not match.")</script>';
          exit;
      }

      // Hash the password
      // password_hash(password, algo)
      // password: The plain-text password to be hashed.
      // bcrypt hashing algorithm by default --> PASSWORD_DEFAULT
      $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

      // Convert date to the correct format
      $convert_format = date("Y-m-d", strtotime($date));

      // Check if SSN or Email already exists
      $stmt = $conn->prepare("SELECT cssn, email FROM customer WHERE cssn = ? OR email = ?");
      $stmt->bind_param("ss", $ssn, $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          echo '<script>alert("SSN or Email already exists.")</script>';
          $stmt->close();
          $conn->close();
          exit;
      }
      $stmt->close();

      // Insert the data into the customer table
      $stmt = $conn->prepare("INSERT INTO customer (cssn, email, fname, lname, cpass, bdate, total_rent) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $total_rent = 0; // Default total rent
      $stmt->bind_param("ssssssi", $ssn, $email, $fname, $lname, $hashed_password, $convert_format, $total_rent);

      if ($stmt->execute()) {
          header("Location: home.php");
          exit;
      } else {
          error_log("Error inserting data: " . $stmt->error);
          echo '<script>alert("An unexpected error occurred. Please try again later.")</script>';
      }

      $stmt->close();
      $conn->close();
  }
?>
