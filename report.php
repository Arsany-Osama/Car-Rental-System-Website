<?php
 session_start();
  // Constants
  include("connection.php");

  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  echo"<title>Admin Report Page</title>";

  echo "<h1>Customer Table</h1>";
  $sql3 = "SELECT * FROM customer";
  $result3 = $conn->query($sql3);

  if ($result3->num_rows > 0) {
    echo "<link rel = 'stylesheet' href='./table.css'/>";
    echo "<table>";
    echo "<tr><th>Cssn</th><th>Email</th><th>Fname</th><th>Lname</th><th>Bdate</th><th>Total Rents</th></tr>";

    while ($row = $result3->fetch_assoc()) {
      echo "<tr><td>" . $row["cssn"] . "</td><td>" . $row["email"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"]  . "</td><td>" . $row["bdate"]  . "</td><td>" . $row["total_rent"]  . "</td></tr>";
    }
  echo "</table>";
  } else {
    echo "No Current Data For Customer Information Table";
  }

  echo "<br>";
  echo "<br>";

  echo "<h1>Cars Table</h1>";
  $sql = "SELECT * FROM car";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th> plate_id </th> <th> brand </th> <th> model </th> <th> color </th> <th> year </th> <th> price_per_hour </th> </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["plate_id"] . "</td><td>" . $row["brand"] . "</td><td>" . $row["model"] . "</td><td>" . $row["color"]  . "</td><td>" . $row["year"]  . "</td><td>" . $row["price_per_hour"]  . "</td></tr>";
    }

    echo "</table>";
  } else {
      echo "No Current Data For Car Information Table";
  }

  echo "<br>";
  echo "<br>";
  echo "<h1>Cars Status</h1>";

  $sql2 = "SELECT * FROM reserved_cars";
  $result2 = $conn->query($sql2);

  if($result2->num_rows > 0){
    echo "<table>";
    echo "<tr><th>Plate_id</th><th>Start_date</th><th>Return_date</th></tr>";

    while ($row = $result2->fetch_assoc()) {
      echo "<tr><td>" . $row["plate_id"] . "</td><td>". $row["start_time"] . "</td><td>" . $row["return_date"] ."</td></tr>";
    } 
    echo "</table>";
  } else {
    echo "No Current Data For Car Status Table";
  }

  echo "<br>";
  echo "<br>";
  echo "<h1>Rent Table</h1>";
  $sql4 = "SELECT * FROM rent";
  $result4 = $conn->query($sql4);
  if($result4->num_rows > 0){
    echo "<table>";
    echo "<tr><th>rent_id</th><th>Cssn</th><th>Plate_id</th><th>total_hours</th><th>start_date</th><th>return_date</th><th>total_price</th></tr>";

  while ($row = $result4->fetch_assoc()) {
    echo "<tr><td>" . $row["rent_id"] . "</td><td>". $row["cssn"] . "</td><td>" . $row["plate_id"] . "</td><td>" . $row["total_hours"] . "</td><td>" . $row["start_date"] . "</td><td>". $row["return_date"]. "</td><td>" . $row["total_price"] ."</td></tr>";
  } 
  echo "</table>";
  } else {
    echo "No Current Data For Car Status Table";
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
  <h1>All Reservstions With Specific Period</h1>
  <form action="" mathod="get" onsubmit="return validate()">
  <label for="">Start Date: </label>
  <input id="start" type="Date" name="_start_date_">
  <br>
  <br>
  <label for="">Return Date</label>
  <input id="end" type="Date" name="_return_date_">
  <br>
  <br>
  <input type="submit" value="Show Result" name="submit">
  </form>
</body>
</html>

<script>
  function validate(){
    var startDate = document.getElementById("start").value;
    if(startDate == ""){
      window.alert("Start Date Not Filled");
      return false;
    }
    var endDate = document.getElementById("end").value;
    if(endDate == ""){
      window.alert("End Date Not Filled");
      return false;
    }

  }
</script>
<?php
  if(isset($_GET["submit"])){
    include("./connection.php");
    $start_date = $_GET["_start_date_"];
    $end_date = $_GET["_return_date_"];
    $sql5 = "SELECT r.rent_id, r.cssn , r.plate_id , r.start_date , r.return_date , c.email , c.fname , c.lname , c.bdate , c.total_rent , car.brand , car.model , car.year , car.price_per_hour , r.total_hours 
    FROM rent AS r JOIN customer AS c ON r.cssn = c.cssn JOIN car ON r.plate_id = car.plate_id WHERE r.start_date >= '$start_date' AND r.return_date <= '$end_date'";
  
    $result5 = $conn->query($sql5);
    if ($result5->num_rows > 0) {
      echo "<section>";
      echo "<table >";
      echo "<tr><th> rent_id </th> <th> cssn </th> <th> plate_id </th> <th> start_date </th> <th> return_date </th> <th> email </th> <th> fname </th> <th> lname </th> <th> bdate </th> <th> total_rent </th> <th>brand</th> <th>model</th> <th>year</th> <th>price_per_hour</th> <th>Total Hours</th> </tr>";
  
      while ($row = $result5->fetch_assoc()) {
          echo "<tr><td>" . $row["rent_id"] . "</td><td>" . $row["cssn"] . "</td><td>" . $row["plate_id"] . "</td><td>" . $row["start_date"]  . "</td><td>" . $row["return_date"]  . "</td><td>" . $row["email"] .  "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td><td>" . $row["bdate"] . "</td><td>" . $row["total_rent"] . "</td><td>" . $row["brand"] . "</td><td>" . $row["model"] . "</td><td>" . $row["year"] . "</td><td>" . $row["price_per_hour"] . "</td><td>" . $row["total_hours"] . "</td></tr>";
      }
      echo "</table>";
    } else {
        echo "No Rented Cars For These Dates";
    }
    echo "</section>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1> Daily payments within a specific period </h1>
  <form action="" mathod="get" onsubmit="return validate1()">
  <label for="">Start Date: </label>
  <input id="start1" type="Date" name="_start_date1_">
  <br>
  <br>
  <label for="">Return Date</label>
  <input id="end1" type="Date" name="_return_date1_">
  <br>
  <br>
  <input type="submit" value="Show Result" name="submit1">
  </form>
</body>
</html>

<script>
  function validate1(){
    var startDate = document.getElementById("start1").value;
    if(startDate == ""){
      window.alert("Start Date Not Filled");
      return false;
    }
    var endDate = document.getElementById("end1").value;
    if(endDate == ""){
      window.alert("End Date Not Filled");
      return false;
    }

  }
</script>
<?php
  if(isset($_GET["submit1"])){
    include("./connection.php");
    $start_date = $_GET["_start_date1_"];
    $end_date = $_GET["_return_date1_"];
    $sql7 = "SELECT r.*, c.*, car.*, r.total_price
    FROM rent AS r
    JOIN customer AS c ON r.cssn = c.cssn
    JOIN car ON r.plate_id = car.plate_id
    WHERE r.start_date >= '$start_date' AND r.return_date <= '$end_date'";
  
    $result7 = $conn->query($sql7);
    if ($result7->num_rows > 0) {
      echo "<section>";
      echo "<table>";
      echo "<tr><th> rent_id </th> <th> cssn </th> <th> plate_id </th> <th> fname </th> <th> email </th> <th> price_per_hour </th> <th> total_hours </th> <th> total_price </th></tr>";
  
      while ($row = $result7->fetch_assoc()) {
          echo "<tr><td>" . $row["rent_id"] . "</td><td>" . $row["cssn"] . "</td><td>" . $row["plate_id"] . "</td><td>"   . $row["fname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["price_per_hour"] . "</td><td>" . $row["total_hours"] . "</td><td>" . $row["total_price"] . "</td></tr>" ;
      }
      echo "</table>";
    } else {
        echo "No Data found";
    }
    echo "</section>";
  }
?>