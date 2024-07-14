<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('bg1.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            margin: 0;
        }
        .container {
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            margin-top: 20px;
            background-color: #8DA7A8;
            border: none;
        }
        .btn-custom:hover {
            background-color: #769294;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>You have been logged out</h2>
        <p>Thank you for visiting. Click the button below to log in again.</p>
        <a href="index.php" class="btn btn-custom">Login</a>
    </div>
</body>
</html>
