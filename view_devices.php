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

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $sql = "SELECT * FROM devices 
            WHERE user_id='$user_id' 
            AND device_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM devices WHERE user_id='$user_id'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Devices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="GET">
    <input type="text" name="search" placeholder="Search device by name">
    <input type="submit" value="Search">
</form>
<br>
    <h2>Your Devices</h2>

    <table border="1" cellpadding="10">
        <tr>
           <th>Device ID</th>
<th>Name</th>
<th>Type</th>
<th>Location</th>
<th>Status</th>
<th>Created At</th>
<th>Action</th>
<th>Change Status</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['device_id']; ?></td>
            <td><?php echo $row['device_name']; ?></td>
            <td><?php echo $row['device_type']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
    <a href="delete_device.php?id=<?php echo $row['device_id']; ?>"
       onclick="return confirm('Are you sure you want to delete this device?');">
       Delete
    </a>
</td>
<td>
    <a href="update_status.php?id=<?php echo $row['device_id']; ?>&status=<?php echo $row['status']; ?>">
        Toggle Status
    </a>
</td>
        </tr>
        <?php } ?>

    </table>
</body>
</html>