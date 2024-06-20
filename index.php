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

  if(isset($_POST['submit'])){

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // if the user is admin
    $sql2 = "SELECT email , password FROM admin WHERE email='$email' AND password='$pass'";
    $result2 = $conn->query($sql2);
    if($result2->num_rows > 0){

      header("Location: adminHome.php");
      
      exit(1);
    }

    $sql = "SELECT email , cpass FROM customer WHERE email = '$email' AND cpass = '$pass'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      // $data = $result[0];
      $_SESSION['user_data'] = $result->fetch_assoc();
      header("Location: home.php");
      
      exit(1);
    }
    else{
      echo '<script>alert("Email Or Password Not Found")</script>';
     
    } 
  }
?>