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

// Fetch admin details
$sql = "SELECT * FROM admin WHERE role='admin'";
$result = $connection->query($sql);

// Check if query was successful
if (!$result) {
    die("Invalid query: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
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
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            background-color: white; /* Add this line for white background */
            border-collapse: collapse; /* Ensure borders are collapsed */
        }
        thead {
            background-color: #D2D4D1;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            
        }
        .btn-sm {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <div class="admin-view">
            <a href="admin_details.php">Admin Details</a>
          <!--  <a href="user_details.php">User Details</a> -->
           <!-- <a href="location_details.php">Location Details</a> -->
            <a href="location.php">List Location of Food Truck</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="content">
        <!-- <div class="container my-5"> -->
        <br>
            <img src="logo.jpg" alt="FoodieFinds Logo" class="logo">

            <br>
        <h2>ADMIN PROFILE</h2>
        <br>
            
            <a class="btn btn-success mb-3" href="add_admin.php" role="button">Add Admin Profile</a>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['password']}</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='edit_admin.php?id={$row['id']}'>EDIT</a>
                                </td>
                                <td>
                                    <a class='btn btn-danger btn-sm' href='delete_admin.php?id={$row['id']}'>DELETE</a>
                                </td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No admin profiles found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
