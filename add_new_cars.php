<?php @include 'header.php' ?>
<?php
  session_start();
  include 'connection.php';
  
  // Check if the user is a car rental agency
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "agency") {
    if(isset($_POST['submit'])) {
      $vehicle_model = $_POST['vehicle_model'];
      $vehicle_number = $_POST['vehicle_number'];
      $seating_capacity = $_POST['seating_capacity'];
      $rent_per_day = $_POST['rent_per_day'];
      
      $sql = "INSERT INTO car (vehicle_model, vehicle_number, seating_capacity, rent_per_day,availability) VALUES ('$vehicle_model', '$vehicle_number', '$seating_capacity', '$rent_per_day',1)";
      if(mysqli_query($conn, $sql)) {
        header("Location: available_cars.php");
        
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  } else {
    // Redirect to login page if the user is not a car rental agency
    header("Location: login.php");
    exit();
  }
?>
<html>
  <head>
    <title>Add New Cars</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      .add{
            display: block;
            position: relative;
            top : 15%;
            padding: 2px;
            text-align: center;
       }

       form input,form label{
        margin:5px 0;
        border-radius: 2px;
       }
       form button{
        text-decoration: none;
        font-weight: 150;
        font-size: 15px;
        border-radius: 5px;
        margin:10px;
       }
    </style>
    
  </head>
  <body>
    <div class="add">
      <h1>Add New Car</h1>
      <form action="" method="post">
        <label for="vehicle_model">Vehicle Model:</label>
        <input type="text" name="vehicle_model" id="vehicle_model">
        <br>
      <label for="vehicle_number">Vehicle Number:</label>
      <input type="text" name="vehicle_number" id="vehicle_number">
      <br>
      <label for="seating_capacity">Seating Capacity:</label>
      <input type="number" name="seating_capacity" id="seating_capacity">
      <br>
      <label for="rent_per_day">Rent Per Day:</label>
      <input type="number" name="rent_per_day" id="rent_per_day">
      <br>
      <button type="submit" name="submit" value="Add Car">Add car</button>
    </form>
    </div>
    
  </body>
</html>
<?php @include 'footer.php' ?>