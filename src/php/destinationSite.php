<!DOCTYPE html>
<?php include_once('dbh.inc.php');
session_start();

$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>University Details</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/destinationSite.css">
</head>
<body>
  <?php
  $destinationID = $_GET['id'];
  $sql = "SELECT destinations.*, states.statename
  FROM destinations
  JOIN states ON destinations.stateID = states.stateID        
  WHERE destinations.destinationID = '$destinationID'
  ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
   <?php 
    if (!empty($username)) {
      include "logged-in-nav.php";
    } else {
      include "nav2.php";
    }
  ?>
  <div class="Banner"></div>
  <div class="container">
    <?php
    echo "<h1>".$row['destinationname']."</h1>";
    echo "<p>".$row['statename']."</p>";
    ?>
    <a href="destination-review.php?id=<?php echo $destinationID; ?>" class="reviews">Reviews</a>
    <?php 
    echo "<p class='description'>".$row['destination_description']."</p>";
    ?>
    <p class="gallery">gallery</p>
  </div>
  <?php include "footer.php"; ?>  
</body>
</html>