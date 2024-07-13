<?php
// db.php
$link = mysqli_connect("localhost", "root", "", "4504534_foodtruck");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>