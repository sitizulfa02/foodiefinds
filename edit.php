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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client
    if (!isset($_GET["id"])) {
        header("location: /index.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the row of the selected client from database table
    $sql = "SELECT * FROM food_trucks WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /location.php");
        exit;
    }

    $operator_name = $row["operator_name"];
    $foodtruck_name = $row["foodtruck_name"];
    $schedule = $row["schedule"];
    $menu_items = $row["menu_items"];
    $longitude = $row["longitude"];
    $latitude = $row["latitude"];

} else {
    // POST method: Update the data of the client
    $id = $_POST["id"];
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

        $sql = "UPDATE food_trucks SET operator_name = '$operator_name', foodtruck_name = '$foodtruck_name', schedule = '$schedule', menu_items = '$menu_items', longitude = '$longitude', latitude = '$latitude' WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

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
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="form-container">
        <h2>Edit Location of Food Truck</h2>

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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Operator Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="operator_name" value="<?php echo $operator_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Food Truck Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="foodtruck_name" value="<?php echo $foodtruck_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Schedule</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="schedule" value="<?php echo $schedule; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Menu</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_items" value="<?php echo $menu_items; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Longitude</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="longitude" value="<?php echo $longitude; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Latitude</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="latitude" value="<?php echo $latitude; ?>">
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
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-6 d-grid">
                    <a class="btn btn-outline-primary" href="/location.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
