<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user_id from database
$username = $_SESSION['username'];
$user_query = "SELECT user_id FROM users WHERE username='$username'";
$user_result = $conn->query($user_query);
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_name = $_POST['device_name'];
    $device_type = $_POST['device_type'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    $sql = "INSERT INTO devices (user_id, device_name, device_type, location, status)
            VALUES ('$user_id', '$device_name', '$device_type', '$location', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Device Added Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Device</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Device</h2>
    <form method="POST">
        Device Name: <input type="text" name="device_name" required><br><br>
        Device Type: <input type="text" name="device_type" required><br><br>
        Location: <input type="text" name="location" required><br><br>
        Status:
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select><br><br>
        <input type="submit" value="Add Device">
    </form>
</body>
</html>