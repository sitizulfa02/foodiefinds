<?php

$servername = "fdb1029.awardspace.net";
$username = "4504534_foodtruck";
$password = "Foodtruck02";
$database = "4504534_foodtruck";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE id='$id'";

    if ($connection->query($sql) === TRUE) {
        header("Location: admin_details.php");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

?>
