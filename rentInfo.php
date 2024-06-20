<?php
  session_start();
  $car = $_SESSION['car'];
  $user = $_SESSION['getUser'];
  function calculateTotalHours($start_date, $end_date) {
    // Create DateTime objects from the date strings
    $start_datetime = new DateTime($start_date);
    $end_datetime = new DateTime($end_date);

    // Calculate the difference between two dates
    $interval = $start_datetime->diff($end_datetime);

    $total_hours = $interval->days * 24 + $interval->h + $interval->i / 60;

    return $total_hours;
  }
  $start = date("y-m-d" , strtotime($_POST['start']));
  $end = date("y-m-d" , strtotime($_POST['return']));
  $total_hours = calculateTotalHours($start , $end);
  $total_price = $total_hours * $car[5];

  include("connection.php");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // increment total_rents by 1
  $user_cssn = $user['cssn'];
  $sql = "UPDATE customer SET total_rent = total_rent + 1 WHERE cssn = '$user_cssn'";

  if ($conn->query($sql) === false) {
    echo "Error updating record: " . $conn->error;
  }

  // insert rent and rent contact
  // rent
  $plate_id = $car[0];
  $start_date = $_POST['start'];
  $return_date = $_POST['return'];
  //rent
  $sql2 = "INSERT INTO rent VALUES(0 , '$user_cssn','$plate_id','$total_hours','$start_date','$return_date','$total_price')";
  
  if($conn->query($sql2) === false){
    echo "Error updating record: " . $conn->error;
  }
  // rent contact
  $_sql_ = "SELECT MAX(rent_id) AS max_value FROM rent";
  $result = mysqli_query($conn, $_sql_);
  $row = mysqli_fetch_assoc($result);
  $rent_id = $row['max_value'];
  $phone1 = @(string)($_POST['phoNum1']);
  $phone2 = @(string)($_POST['phoNum2']);

  $sql3 = "INSERT INTO rent_contact VALUES('$rent_id','$phone1','$phone2')";
  if ($conn->query($sql3) === false) {
    echo "Error updating record: " . die($conn->error);
  }

  // reserved_cars
  $sql4 = "INSERT INTO reserved_cars VALUES('$plate_id','$start_date','$return_date')";
  if ($conn->query($sql4) === false) {
    echo "Error updating record: " . die($conn->error);
  }

  // cutomer address
  $country = $_POST['_country_']; 
  $city = $_POST['_city_']; 
  $street = $_POST['_street_']; 
  $sql5 = "INSERT INTO customer_address VALUES(0 ,'$user_cssn','$country','$city','$street')";
  if ($conn->query($sql5) === false) {
    echo "Error updating record: " . die($conn->error);
  }

  //rent address
  $get_current_rent_id = $rent_id;
  $__sql__ = "SELECT MAX(address_id) AS max_value FROM customer_address";
  $result2 = mysqli_query($conn, $__sql__);
  $row2 = mysqli_fetch_assoc($result2);
  $get_current_address_id = (int)$row2['max_value'];
  $sql5 = "INSERT INTO rent_address VALUES('$get_current_rent_id' , '$get_current_address_id')";
  if ($conn->query($sql5) === false) {
    echo "Error updating record: " . die($conn->error);
  }

  $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Rent Information</h1>
  <form action="./home.php">
    <label for="">First Name: </label>
    <input type="text" value="<?=$user['fname']?>" readonly> 
    <br>
    <br>
    <label for="">Last Name: </label>
    <input type="text" value="<?=$user['lname']?>" readonly>
    <br>
    <br>
    <label for="">Gmail: </label>
    <input type="text" value="<?=$user['email']?>" readonly>
    <br>
    <br>
    <label for="">Phone Number1: </label>
    <input type="text" value="<?=$_POST['phoNum1']?>" readonly>
    <br>
    <br>
    <label for="">Phone Number2: </label>
    <input type="text" value="<?=$_POST['phoNum2']?>" readonly>
    <br>
    <br>
    <label for="">Country: </label>
    <input type="text" value="<?=$_POST['_country_']?>" readonly>
    <br>
    <br>
    <label for="">City: </label>
    <input type="text" value="<?=$_POST['_city_']?>" readonly>
    <br>
    <br>
    <label for="">Street: </label>
    <input type="text" value="<?=$_POST['_street_']?>" readonly>
    <br>
    <br>
    <label for="">Start Date: </label>
    <input type="text" value="<?=$_POST['start']?>" readonly>
    <br>
    <br>
    <label for="">End Date: </label>
    <input type="text" value="<?=$_POST['return']?>" readonly>
    <br>
    <br>
    <label for="">Car: </label>
    <input type="text" value="<?=$car[3]?>" readonly>
    <br>
    <br>
    <label for="">Model: </label>
    <input type="text" value="<?=$car[2]?>" readonly>
    <br>
    <br>
    <label for="">Total Hours: </label>
    <input type="text" value="<?=$total_hours?>" readonly>
    <br>
    <br>
    <label for="">Price: </label>
    <input type="text" value="<?=$total_price?>" readonly>
    <br>
    <br>
    <input type="button" value="Go To HomePage" onClick='window.open("home.php")'>
  </form>
  <br>
  <br>
  <textarea name="" id="" cols="30" rows="10">
    policy
    We Will Contact You Latter
  </textarea>
</body>
</html>

