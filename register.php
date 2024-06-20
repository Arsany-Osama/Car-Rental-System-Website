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
      <input type="text" required name="ssn">
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

      <div class="forget">
        </label>
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
    if(isset($_POST['submit'])){

      include("connection.php");

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $ssn = $_POST["ssn"];
      $email = $_POST["email"];
      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $pass = $_POST["password"];
      $cpass = $_POST["cpassword"];
      $date = $_POST["date"];
      $convert_format = date("y-m-d" , strtotime($date));

      // Check If Ssn And Email ALready Exist In The Database
      $check = "SELECT email , cssn FROM customer WHERE email = '$email' AND cssn = '$ssn'";
      $result = $conn->query($check);

      if($result->num_rows > 0){
        echo '<script>alert("Email Or Ssn Already Exists")</script>';
        $conn->close();
      }
      else{
        // insert the data to customer relation
        $sql = "INSERT INTO customer VALUES ('$ssn' , '$email' , '$fname' , '$lname' , '$pass'  , '$convert_format' , 0)";
        if ($conn->query($sql) === TRUE) {
          header("Location: home.php");
          exit(1);
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
      }
    }
  ?>