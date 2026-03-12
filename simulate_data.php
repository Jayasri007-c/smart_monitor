<?php
include 'db.php';

// Select all active devices
$device_query = "SELECT device_id FROM devices WHERE status='Active'";
$device_result = $conn->query($device_query);

if ($device_result->num_rows > 0) {

    while ($device_row = $device_result->fetch_assoc()) {

        $device_id = $device_row['device_id'];

        // Generate random values
        $temperature = rand(20, 45);
        $humidity = rand(40, 90);

        // Insert sensor data
        $insert_query = "INSERT INTO sensor_data (device_id, temperature, humidity)
                         VALUES ('$device_id', '$temperature', '$humidity')";
        $conn->query($insert_query);

        // Alert logic
        if ($temperature > 40) {
            $alert_message = "High Temperature Alert! Temp: $temperature °C";
            $alert_query = "INSERT INTO alerts (device_id, message)
                            VALUES ('$device_id', '$alert_message')";
            $conn->query($alert_query);
        }

        echo "Device ID: $device_id | Temp: $temperature °C | Humidity: $humidity %<br>";
    }

} else {
    echo "No active devices found!";
}
?>

<!-- <?php
include 'db.php';

// Select one active device (for now)
$device_query = "SELECT device_id FROM devices WHERE status='Active' LIMIT 1";
$device_result = $conn->query($device_query);

if ($device_result->num_rows > 0) {
    $device_row = $device_result->fetch_assoc();
    $device_id = $device_row['device_id'];

    // Generate random values
    $temperature = rand(20, 45);
    $humidity = rand(40, 90);

    // Alert logic
if ($temperature > 40) {
    $alert_message = "High Temperature Alert! Temp: $temperature °C";
    $alert_query = "INSERT INTO alerts (device_id, message)
                    VALUES ('$device_id', '$alert_message')";
    $conn->query($alert_query);
}

    $insert_query = "INSERT INTO sensor_data (device_id, temperature, humidity)
                     VALUES ('$device_id', '$temperature', '$humidity')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Sensor data inserted successfully!";
        echo "<br>Temperature: $temperature °C";
        echo "<br>Humidity: $humidity %";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No active device found!";
}
?> -->