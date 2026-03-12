<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $device_id = $_GET['id'];
    $current_status = $_GET['status'];

    // Toggle status
    if ($current_status == "Active") {
        $new_status = "Inactive";
    } else {
        $new_status = "Active";
    }

    $update_query = "UPDATE devices SET status='$new_status' WHERE device_id='$device_id'";
    $conn->query($update_query);
}

header("Location: view_devices.php");
exit();
?>