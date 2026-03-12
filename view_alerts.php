<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_query = "SELECT user_id FROM users WHERE username='$username'";
$user_result = $conn->query($user_query);
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'];

$alert_query = "SELECT a.*, d.device_name 
                FROM alerts a
                JOIN devices d ON a.device_id = d.device_id
                WHERE d.user_id = '$user_id'
                ORDER BY a.created_at DESC";

$alert_result = $conn->query($alert_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Alerts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Device Alerts</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Device Name</th>
        <th>Alert Message</th>
        <th>Created At</th>
    </tr>

    <?php while($row = $alert_result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['device_name']; ?></td>
        <td><?php echo $row['message']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>