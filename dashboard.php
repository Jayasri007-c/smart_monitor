<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$username = $_SESSION['username'];
$user_query = "SELECT user_id FROM users WHERE username='$username'";
$user_result = $conn->query($user_query);
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'];

// Total devices
$total_devices_query = "SELECT COUNT(*) AS total FROM devices WHERE user_id='$user_id'";
$total_devices_result = $conn->query($total_devices_query);
$total_devices = $total_devices_result->fetch_assoc()['total'];

// Active devices
$active_devices_query = "SELECT COUNT(*) AS active FROM devices WHERE user_id='$user_id' AND status='Active'";
$active_devices_result = $conn->query($active_devices_query);
$active_devices = $active_devices_result->fetch_assoc()['active'];

// Total alerts
$total_alerts_query = "SELECT COUNT(*) AS alerts 
                       FROM alerts a
                       JOIN devices d ON a.device_id = d.device_id
                       WHERE d.user_id='$user_id'";
$total_alerts_result = $conn->query($total_alerts_query);
$total_alerts = $total_alerts_result->fetch_assoc()['alerts'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>System Statistics</h3>
<p>Total Devices: <?php echo $total_devices; ?></p>
<p>Active Devices: <?php echo $active_devices; ?></p>
<p>Total Alerts: <?php echo $total_alerts; ?></p>
<hr>
<ul>
    <li><a href="add_device.php">Add Device</a></li>
    <li><a href="view_devices.php">View Devices</a></li>
    <li><a href="simulate_data.php">Simulate Sensor Data</a></li>
    <li><a href="view_sensor_data.php">View Sensor Data</a></li>
    <li><a href="view_alerts.php">View Alerts</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>