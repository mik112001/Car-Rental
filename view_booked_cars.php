<?php
session_start();

// if (!isset($_SESSION['id'])) {
//     header('Location: login.php');
//     exit;
// }

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'agency') {
    header('Location: home.php');
    exit;
}

// Connect to database
include 'connection.php';

$query = "SELECT * FROM booking WHERE id = '".$_SESSION['id']."'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Vehicle Model</th><th>Vehicle Number</th><th>Start Date</th><th>Number of Days</th><th>Customer ID</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['vehicle_model'] . "</td>";
        echo "<td>" . $row['vehicle_number'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $row['number_of_days'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found";
}

$conn->close();
