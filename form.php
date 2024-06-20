<?php
  session_start();
    // Constants
    include("connection.php");

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

  // Check The Dates Is Valid
  // if(isset($_POST['submit'])){
  //   $chosen_start_date = $_POST['start'];
  //   $chosen_return_date = $_POST['return'];

  //   $currentDate = new DateTime();
  //   $userSelectedDate = new DateTime($chosen_start_date);
  //   $user_return_date = new DateTime($chosen_return_date);
  //   if($userSelectedDate < $currentDate){
  //     echo '<script>alert("Your Start Date Is Invalid")</script>';
  //     exit(1);
  //   }
  //   elseif($userSelectedDate == $user_return_date){
  //     echo '<script>alert("You Cannot Book A Car In Less Than One Day")</script>';
  //     exit(1);
  //   }
  //   //Check If The Car Is Booked
  //   $get_plate_id = $_GET['plate_id'];
  //   $sql3 = "SELECT * FROM reserved_cars WHERE plate_id = '$get_plate_id' AND ((start_time BETWEEN '$chosen_start_date' AND '$chosen_return_date') OR (return_date BETWEEN '$chosen_start_date' AND '$chosen_return_date'))";
  //   $result = $conn->query($sql3);
  //   if ($result->num_rows > 0){
  //     echo '<script>alert("This Car Is Booked For This Time")</script>';
  //     exit(1);
  //   }
  // }

  $plate = $_GET['plate_id'];

  $Data = $_SESSION['getData'];

  $car_data = Array();


  for($i = 0 ; $i < sizeof($Data) ; $i++){
    if($Data[$i][0] == $plate){
      $car_data = $Data[$i];
    }
  }

  $_SESSION['car'] = $car_data;

  $user = $_SESSION['user_data'];

  $em = $user['email'];

  $sql = "SELECT * FROM customer WHERE email = '$em'";

  $fullDataUser = $conn->query($sql)->fetch_assoc();

  $conn->close();

  $_SESSION['getUser'] = $fullDataUser;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="form.css">
  <title>Fill Form</title>
</head>
<body>
  <img src="<?=$car_data[1]?>" alt="" width="900px" height="500px" >
  <div class="container">
    <form action="./rentInfo.php" method="post" onsubmit="return validate()">
      <div class="input-box">
        <span>Brand</span>
        <input type="text" readonly value="<?=$car_data[3]?>">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Model</span>
        <input type="text" readonly value="<?=$car_data[2]?>">
      </div>
      <?php
        include("connection.php");
        // Check the connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $user_email = $user['email'];
        $sql = "SELECT fname , lname , email FROM customer WHERE email='$user_email'";
        $result = $conn->query($sql);
        $user_data = $result->fetch_assoc();

        $sql2 = "SELECT description FROM car WHERE plate_id='$plate'";
        $result2 = $conn->query($sql2);
        $car_details = $result2->fetch_assoc();
        $conn->close();
      ?>
      <br>
      <br>
      <div class="input-box">
        <span>First Name</span>
        <input type="text" readonly value="<?=$user_data['fname']?>">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Last Name</span>
        <input type="text" readonly value="<?=$user_data['lname']?>">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Email</span>
        <input type="text" readonly value="<?=$user_data['email']?>">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Start-date</span>
        <input id="startDate" type="date" placeholder="start-date" name="start">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Return-date</span>
        <input id="returnDate" type="date" placeholder="Return-date" name="return">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Phone number 1</span>
        <input id="phoneNum1" type="text" placeholder="enter your number" name="phoNum1">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Phone number 2</span>
        <input id="phoneNum2" type="text" placeholder="enter your number" name="phoNum2">
      </div>
      <br>
      <br>
      <div class="input-box">
        <span>Country</span>
        <input id="country" type="text" placeholder="enter country" name="_country_">
      </div>
      <div class="input-box">
        <span>city</span>
        <input id="city" type="text" placeholder="enter city" name="_city_">
      </div>
      <div class="input-box">
        <span>street</span>
        <input id="street" type="text" placeholder="enter street" name="_street_">
      </div>
      <div class="desc-container">
        <textarea name="" id="" cols="70" rows="15"><?=$car_details['description']?></textarea>
      </div>
      <div class="input-box">
  <input type="submit" class="btn" name="submit" style="background-color: #ff0000; color: #ffffff;">
     </div>

    </form>
  </div>
</body>
</html>
<script>
  function validate(){
    var startDate = document.getElementById('startDate').value;
    if(startDate == ""){
      alert("Start Date Not Filled");
      return false;
    }

    var returnDate = document.getElementById('returnDate').value;
    if(returnDate == ""){
      alert("Return Date Not Filled");
      return false;
    }

    var phoneNum1 = document.getElementById('phoneNum1').value;
    if(phoneNum1 == ""){
      alert("Phone Number 1 Not Filled");
      return false;
    }

    var phoneNum2 = document.getElementById('phoneNum2').value;
    if(phoneNum2 == ""){
      alert("Phone Number 2 Not Filled");
      return false;
    }

    var country = document.getElementById('country').value;
    if(country == ""){
      alert("Country Not Filled");
      return false;
    }

    var city = document.getElementById('city').value;
    if(city == ""){
      alert("City Not Filled");
      return false;
    }

    var street = document.getElementById('street').value;
    if(street == ""){
      alert("Street Not Filled");
      return false;
    }
  }
</script>