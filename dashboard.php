<?php

// Database connection
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

// Function to get count from a table
function getCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) as count FROM $table");
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        echo "Error executing query for table $table: " . $conn->error;
        return 0;
    }
}

// Fetch total counts
$adminCount = getCount($connection, 'admin');
$clientsCount = getCount($connection, 'food_trucks');

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: url('bg1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 200px;
            height: auto;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #8DA7A8;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <div class="admin-view">
            <a href="admin_details.php">Admin Details</a>
            <!-- <a href="location_details.php">Location Details</a> -->
            <a href="location.php">List Location of Food Truck</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="content text-center">
    <br>

        <img src="logo.jpg" alt="Logo" class="logo">
        <br>
        <h2 >DASHBOARD</h2>
        <br>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        TOTAL REGISTERED ADMIN
                    </div>
                    <div class="card-body text-center">
                        <h1><?php echo $adminCount; ?></h1>
                        <p>Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        TOTAL LOCATION OF FOOD TRUCK
                    </div>
                    <div class="card-body text-center">
                        <h1><?php echo $clientsCount; ?></h1>
                        <p>Location of Food Truck</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
