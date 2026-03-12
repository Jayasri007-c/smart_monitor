<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $device_id = $_GET['id'];

    $delete_query = "DELETE FROM devices WHERE device_id='$device_id'";
    $conn->query($delete_query);
}

header("Location: view_devices.php");
exit();
?>