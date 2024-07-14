<?php
session_start();

// Replace with your database credentials
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = $connection->real_escape_string($username);
    $password = $connection->real_escape_string($password);

    // Check credentials (Assuming you have a users table with username and password columns)
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('bg1.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .login-header {
            background-color: #8DA7A8;
            color: white;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            text-align: center;
            margin: -20px -20px 20px -20px;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #8DA7A8;
            border: none;
        }
        .btn-custom:hover {
            background-color: #7c9798;
        }
    </style>
</head>
<body>
    <img src="logo.jpg" alt="Logo" class="logo">
    <div class="login-container">
        <div class="login-header">Login</div>
        <form action="dashboard.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
    </div>
</body>
</html>
