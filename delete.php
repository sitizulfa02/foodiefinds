<?php
if (isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "fdb1029.awardspace.net";
    $username = "4504534_foodtruck";
    $password = "Foodtruck02";
    $database = "4504534_foodtruck";

//Create connection 
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM food_trucks WHERE id = $id";
$connection->query($sql);

}

header("location: /location.php");
exit;
?>