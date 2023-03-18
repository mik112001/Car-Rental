<?php @include 'header.php' ?>
<html>
<head>
  <title>Available Cars</title>
  <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
  <div class="available">
  <h1>Available Cars</h1>
  <table>
    <tr>
      <th>Vehicle Model</th>
      <th>Vehicle Number</th>
      <th>Seating Capacity</th>
      <th>Rent per Day</th>
    </tr>
    <?php
    session_start();
    // Connect to the database
    @include 'connection.php';

    // Get all the available cars from the database
    $sql = "SELECT * FROM car WHERE availability = 1";
    $result = mysqli_query($conn, $sql);

    // Loop through the result and display the cars
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['vehicle_model'] . "</td>";
      echo "<td>" . $row['vehicle_number'] . "</td>";
      echo "<td>" . $row['seating_capacity'] . "</td>";
      echo "<td>" . $row['rent_per_day'] . "</td>";
      
      // Check if the user is logged in
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        // Check if the user is a customer
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer') {
            ?>
            <form action="view_booked_cars.php" method="post">
            <th>No_of_days</th>
            <td>
                <input type="number" name="no_of_days">
            </td>
            <th>start_date</th>
            <td>
                <input type="date" name="start_date">
            </td>
           </form>
          <?php 
          echo "<td><a href='rent_car.php'> Rent Car </a></td>";
        
        }
        else if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'agency'){
            echo "<td><a href='rent_car.php'> Rent Car </a></td>";   
        } 
        else {
          echo "<td> Not allowed to rent </td>";
        }
      } 
      else {
        echo "<td><a href='login.php'> Login to Rent </a></td>";
      }
      
      echo "</tr>";
    }

    // Close the connection
    mysqli_close($conn);
    ?>
  </table>
  </div>
  
</body>
</html>
<?php @include 'footer.php' ?>