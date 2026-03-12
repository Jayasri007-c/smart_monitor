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

$device_query = "SELECT device_id, device_name FROM devices WHERE user_id='$user_id'";
$device_result = $conn->query($device_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Sensor Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>View Sensor Data</h2>

<form method="GET">
    <label>Select Device:</label>
    <select name="device_id" required>
        <?php while($device = $device_result->fetch_assoc()) { ?>
            <option value="<?php echo $device['device_id']; ?>">
                <?php echo $device['device_name']; ?>
            </option>
        <?php } ?>
    </select>
    <input type="submit" value="View Data">
</form>

<?php
if (isset($_GET['device_id'])) {
    $device_id = $_GET['device_id'];

    $data_query = "SELECT * FROM sensor_data WHERE device_id='$device_id' ORDER BY recorded_at DESC";
    $data_result = $conn->query($data_query);

    echo "<h3>Sensor Records:</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Temperature</th><th>Humidity</th><th>Recorded At</th></tr>";

    while($row = $data_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['temperature']." °C</td>";
        echo "<td>".$row['humidity']." %</td>";
        echo "<td>".$row['recorded_at']."</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

</body>
</html>