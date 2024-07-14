<?php
    $servername = "fdb1029.awardspace.net";
    $username = "4504534_foodtruck";
    $password = "Foodtruck02";
    $database = "4504534_foodtruck";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$operator_name = "";
$schedule = "";
$foodtruck_name = "";
$menu_items = "";
$longitude = "";
$latitude = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operator_name = $_POST["operator_name"];
    $schedule = $_POST["schedule"];
    $foodtruck_name = $_POST["foodtruck_name"];
    $menu_items = $_POST["menu_items"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];

    do {
        if (empty($operator_name) || empty($schedule) || empty($foodtruck_name) || empty($menu_items) || empty($longitude) || empty($latitude)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new client to database
        $sql = "INSERT INTO food_trucks (operator_name, schedule, foodtruck_name, menu_items, longitude, latitude) VALUES ('$operator_name', '$schedule', '$foodtruck_name', '$menu_items', '$longitude', '$latitude')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $operator_name = "";
        $schedule = "";
        $foodtruck_name = "";
        $menu_items = "";
        $longitude = "";
        $latitude = "";

        $successMessage = "Location Food Truck added correctly";

        header("Location: /location.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieFinds</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5 text-center">
    <h2>New Location of Food Truck</h2>
    <br>

    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Operator Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="operator_name" value="<?php echo $operator_name; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Food Truck Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="foodtruck_name" value="<?php echo $foodtruck_name; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Schedule</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="schedule" value="<?php echo $schedule; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Menu</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="menu_items" value="<?php echo $menu_items; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Latitude</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="latitude" value="<?php echo $latitude; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Longitude</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="longitude" value="<?php echo $longitude; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Add Location of Food Truck</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/location.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
