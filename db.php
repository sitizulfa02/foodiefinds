<?php
// db.php
$link = mysqli_connect("fdb1029.awardspace.net", "4504534_foodtruck", "Foodtruck02", "4504534_foodtruck");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>