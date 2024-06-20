<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="adminstyle.css">

</head>
<body>

    <div class = "wrapper">
    <form action="" method="post">

    <h1>Admin</h1>

    <div class = "input-field">
        <input type="text" required placeholder="plate-id" name="plateID">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="brand" name="Brand">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="model" name="Model">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="year" name="Year">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="color" name="Color">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="price per hour" name="price_per_hour">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="path of image" name="Image">
    </div>

    <div class = "input-field">
        <input type="text" required placeholder="Car Description" name="Description">
    </div>

    <button type="submit" name="submit">Add Car</button>

    <button type="submit" name="submit2" onClick="window.open('report.php')">Report</button>

</form>
</div>

</body>
</html>
<?php
    if(isset($_POST['submit'])){
        include("connection.php");
        
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $plate_id = (int)($_POST["plateID"]);
    $brand = $_POST["Brand"];
    $model = $_POST["Model"];
    $year = (int)($_POST["Year"]);
    $color = $_POST["Color"];
    $price_per_hour = (float)($_POST["price_per_hour"]);
    $image = $_POST["Image"];
    $description = $_POST["Description"];

    // check if plate id exists
    $sql = "SELECT plate_id FROM car WHERE plate_id = '$plate_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<script>alert("This Car Already Exist")</script>';
        $conn->close();
        exit(1);
    }

    // adding the car

    $sql2 = "INSERT INTO car VALUES ('$plate_id','$model','$color','$brand','$year','$image','$description','$price_per_hour')";

    if ($conn->query($sql2) === TRUE) {
        echo '<script>alert("Car Added Successfully")</script>';
        $conn->close();
        exit(1);
    } else {
        echo "<script>console.log($conn->error)</script>";
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
?>