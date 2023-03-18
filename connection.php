<?php

// Create a connection to the database
$conn=mysqli_connect('localhost','root','','userinfo');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
