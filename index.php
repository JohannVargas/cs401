<?php
session_start();

$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Findmeabreak</title>
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="stylesheet" href="src/css/footer.css">
</head>
<body>
  <?php 
    if (!empty($username)) {
      include "src/php/logged-in-nav.php";
    } else {
      include "src/php/nav.php";
    }
  ?>
  <div class="banner">
    <div class="welcome_text">Discover your college's spring
      break dates and plan the
      perfect getaway to popular
      destinations near you.  
    </div>
  </div>

  <div class="popular-destinations">
    <div class="destination-box">
      <img src="images/destination-1.jpg" alt="Destination 1">
      <h3>New York City</h3>
    </div>
    <div class="destination-box">
      <img src="images/destination-2.jpg" alt="Destination 2">
      <h3>Miami Beach</h3>
    </div>
    <div class="destination-box">
      <img src="images/destination-3.jpg" alt="Destination 3">
      <h3>Las Vegas</h3>
    </div>
    <div class="destination-box">
      <img src="images/destination-4.jpg" alt="Destination 4">
      <h3>Los Angeles</h3>
    </div>
  </div>


  <?php include "src/php/footer.php"; ?> 


</body>
</html>