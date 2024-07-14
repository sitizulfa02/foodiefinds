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

$id = $_GET['id'];

// Fetch the existing data
$sql = "SELECT * FROM admin WHERE id='$id'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $fullname = $row['fullname'];
    $email = $row['email'];
    $contact = $row['contact'];
    $address = $row['address'];
    $password = $row['password'];
} else {
    echo "No record found";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $sql = "UPDATE admin SET username='$username', fullname='$fullname', email='$email', contact='$contact', address='$address', password='$password' WHERE id='$id'";
    
    if ($connection->query($sql) === TRUE) {
        header("Location: admin_details.php");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Admin Profile</h2>
        <form action="edit_admin.php?id=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">Fullname:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Update Admin</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/4504534_foodtruck/admin_details.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
</html>
