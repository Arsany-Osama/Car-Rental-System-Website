
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">

    <title>Document</title>
</head>
<body>
        <!--webpage header-->
<header>
    <div class="navbar">
    
        
<form action="">
    <input type="submit" name="Logout" value="Logout" class="btn">
            
        <h1 id="header">Rent Now</h1>
        
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">FAQs</a></li>
        </ul>
        </div>
    </form>
</header>

<section class="landpage" id="landpage">
    <div class="home-txt">
    <h1 id="txt1">Car Rental Website</h1>
</div>


<div class="form-container">
    <form action="">
    
        <div class="input-box">
            <span>Brand</span>
            <input type="text" name ="brand" placeholder="Car Brand">
        </div>
        
        <div class="input-box">
            <span>Model</span>
            <input type="text" name="model" placeholder="Car model">
        </div>
    
        <div class="input-box">
            <span>Color</span>
            <input type="text" name="color" placeholder="Car Color">
        </div>
    
        <div class="input-box">
            <span>Production year</span>
            <input type="text" name="year" placeholder="Year">
        </div>
    
    <input type="submit" name="search" value="Search" class="btn">
    </form>
    </div>

    <!--car sample for view-->
    

</section>



<?php
session_start();
include("connection.php");

if(isset($_GET['Logout'])){
    header("Location: index.php");
    session_destroy();
    exit(1);
}

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit(1);
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve car information from the database
$sql = "SELECT car.*, reserved_cars.plate_id AS reserved_plate_id FROM car LEFT JOIN reserved_cars ON car.plate_id = reserved_cars.plate_id";
$result = $conn->query($sql);

//creating global array that takes all info
global $collection;
$collection = Array();

// Check if there are any results
if ($result->num_rows > 0) {
    echo '<section class="cars-section" id="cars-section">';
    echo '<div class="section-header">';
    echo '<h1 id="cars">All cars for rent</h1>';
    echo '</div>';
    echo '<div class="car-container">';
    // Loop through each row of the result


    while ($row = $result->fetch_assoc()) {
        $image_path = $row['image'];
        $model = $row['model'];
        $brand = $row['brand'];
        $year = $row['year'];
        $price_per_hour = $row['price_per_hour'];
        $color = $row['color'];
        $plate_id = $row['plate_id'];
        $reserved_plate_id = $row['reserved_plate_id'];

        array_push($collection, [$plate_id, $image_path, $model, $brand, $year, $price_per_hour, $color]);

        echo '<div class="box">';
        echo '<div class="box-img">';
        echo '<img src="' . $image_path . '" alt="" style="border-radius: 20;">';
        echo '</div>';
        echo '<h3>' . $brand . ' ' . $model . '</h3>';
        echo '<p>' . $year . '</p>';
        echo '<p>' . $price_per_hour . ' $/hour</p>';
        echo '<p>' . $color . '</p>';

        if ($reserved_plate_id == $plate_id) {
            echo '<button disabled class="btn" style="background-color: grey; color: white; cursor: not-allowed;">Rented</button>';

        } else {
            echo '<form action="./form.php" method="get" target="_blank">';
            echo '<input type="hidden" name="plate_id" value="' . $plate_id . '">';
            echo '<input type="submit" value="Rent" class="btn">';
            echo '</form>';
        }

        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo 'No cars available for rent.';
}

$_SESSION['getData'] = @$collection;


// Check if the search button is pressed
if (isset($_GET['search'])) {
    // Get the search input values from the form
    $brand = $_GET['brand'] ?? "";
    $model = $_GET['model'] ?? "";
    $color = $_GET['color'] ?? "";
    $year = $_GET['year'] ?? "";

    // Start building the initial query
    $sql = "SELECT car.*, reserved_cars.plate_id AS reserved_plate_id FROM car LEFT JOIN reserved_cars ON car.plate_id = reserved_cars.plate_id WHERE ";

    // Create an array to store the conditions
    $conditions = array();

    // Add conditions if the inputs are not empty
    if (!empty($brand)) {
        $conditions[] = "brand = '$brand'";
    }
    if (!empty($model)) {
        $conditions[] = "model = '$model'";
    }
    if (!empty($color)) {
        $conditions[] = "color = '$color'";
    }
    if (!empty($year)) {
        $conditions[] = "year = '$year'";
    }

    // Check if any conditions were added
    if (!empty($conditions)) {
        // Join the conditions with "AND" and add them to the query
        $sql .= implode(" AND ", $conditions);
    } else {
        echo '<section class="cars-section" id="cars-section">';
        echo '<div class="section-header">';
        echo '<h1 id="cars">Search Results</h1>';
        echo '</div>';
        echo '<div class="car-container">';
        echo '<p>Please provide at least one search criteria</p>';
        echo '</div>';
        echo '</section>';
        exit; // Stop further execution
    }

    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        echo '<section class="cars-section" id="cars-section">';
        echo '<div class="section-header">';
        echo '<h1 id="cars">Search Results</h1>';
        echo '</div>';
        echo '<div class="car-container">';
        // Loop through each row of the result
        while ($row = $result->fetch_assoc()) {
            $image_path = $row['image'];
            $model = $row['model'];
            $brand = $row['brand'];
            $year = $row['year'];
            $price_per_hour = $row['price_per_hour'];
            $color = $row['color'];
            $plate_id = $row['plate_id'];
            $reserved_plate_id = $row['reserved_plate_id'];
    
            array_push($collection, [$plate_id, $image_path, $model, $brand, $year, $price_per_hour, $color]);
    
            echo '<div class="box">';
            echo '<div class="box-img">';
            echo '<img src="' . $image_path . '" alt="" style="border-radius: 20;">';
            echo '</div>';
            echo '<h3>' . $brand . ' ' . $model . '</h3>';
            echo '<p>' . $year . '</p>';
            echo '<p>' . $price_per_hour . ' $/hour</p>';
            echo '<p>' . $color . '</p>';
    
            if ($reserved_plate_id == $plate_id) {
                echo '<button disabled class="btn">Rented</button>';
            } else {
                echo '<form action="./form.php" method="get" target="_blank">';
                echo '<input type="hidden" name="plate_id" value="' . $plate_id . '">';
                echo '<input type="submit" value="Rent" class="btn">';
                echo '</form>';
            }
    
            echo '</div>';
        }
        echo '</div>';
        echo '</section>';
    } else {
        echo '<section class="cars-section" id="cars-section">';
        echo '<div class="section-header">';
        echo '<h1 id="cars">Search Results</h1>';
        echo '</div>';
        echo '<div class="car-container">';
        echo '<p>No cars available matching your search</p>';
        echo '</div>';
        echo '</section>';
    }
}


$conn->close();
?>

<section class="footer">
    <div class="footer-content">
<img src= "https://www.pngmart.com/files/22/Mercedes-Benz-G-Class-PNG-Picture.png">
</div>

<div class="footer-content">
    <h4>CEOs</h4>
    <a href="#">Ahmed (CEO)</a>
    <br>
    <a href="#">Arsany (CTO)</a>
    <br>
    <a href="#">Mark (Office Boy)</a>
</div>

<div class="footer-content">
    <h4>Agency</h4>
    <a href="#">Contact us</a>
    <br>
    <a href="#">Our policy</a>
    <br>
    <a href="#">About us</a>
    <br>
    <a href="#">FAQs</a>
</div>

<div class="footer-content">
    <h4>More</h4>
    <a href="#">services</a>
    <br>
    <a href="#">support</a>
    <br>
    <a href="#">renting policy</a>
</div>

</section>

</body>
</html>

<?php
    if(isset($_POST["submit3"])){
        session_destroy();
        header("Location: index.php");
    }

?>