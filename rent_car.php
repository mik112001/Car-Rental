<?php
session_start();

// if (!isset($_SESSION['id'])) {
//     header('Location: login.php');
//     exit;
// }

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    echo "<td> Not allowed to rent </td>";
    // header('Location: home.php');
    exit;
}

if (!isset($_POST['vehicle_model']) || !isset($_POST['vehicle_number']) || !isset($_POST['start_date']) || !isset($_POST['number_of_days'])) {
    header('Location: available_cars.php');
    exit;
}

$vehicle_model = $_POST['vehicle_model'];
$vehicle_number = $_POST['vehicle_number'];
$start_date = $_POST['start_date'];
$number_of_days = $_POST['number_of_days'];

// Connect to database
include 'connection.php';

$query = "INSERT INTO booking (vehicle_model, vehicle_number, start_date, no_of_days, customer_id,car_id) VALUES ('$vehicle_model', '$vehicle_number', '$start_date', '$number_of_days', '".$_SESSION['user_id']."','".$_SESSION['car_id']."')";

if (!$conn->query($query)) {
    echo "Error:" . $conn->error;
} else {
    header('Location: home.php');
    exit;
}

$conn->close();
?>