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
  <link rel="stylesheet" href="../css/collegeSite.css">
  <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
  <?php $collegeID = $_GET['id'];
  $sql = "SELECT collegelist.*, states.statename
  FROM collegelist
  JOIN states ON collegelist.stateID = states.stateID
  WHERE collegelist.ID = '$collegeID'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $stateID = $row['stateID'];
  $sql2 = "SELECT * FROM destinations WHERE stateID = '$stateID' LIMIT 4";
  $result2 = mysqli_query($conn, $sql2);
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
    <?php echo "<h1>".$row['name']."</h1>"?>
    <?php echo "<h2>".$row['statename']."</h2>"?>
    <img src="images/logo.jpg" alt="Logo" class="location-image">
    <a href="college-reviews.php?id=<?php echo $collegeID; ?>" class="reviews">Reviews</a>
    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit bibendum magna, eu pellentesque dolor blandit nec. Aliquam erat volutpat. Integer venenatis vel ex a vestibulum. Duis ultrices, libero eu eleifend ultrices, nisl dolor eleifend dolor, a semper velit enim vel lorem. Morbi in malesuada eros, eu sagittis purus. Donec venenatis augue non nulla sollicitudin scelerisque. Nulla facilisi. Morbi sodales, libero vel dictum tristique, massa quam maximus eros, nec varius est lectus vel velit.</p>

    <div class="destinations">
  <?php
    while ($row2 = mysqli_fetch_assoc($result2)) {
      echo "<div class='destination'>";
      echo "<img src='images/destination1.jpg' alt='Destination 1' class='destination-image'>";
      echo "<p onclick='goToDestination(\"".$row2["destinationname"]."\",".$row2["destinationID"].")'>" . $row2['destinationname'] . "</p>";
      echo "</div>";
    }
  ?>
</div>
  </div>
  <?php include "footer.php"; ?> 
  <script>
    function goToDestination(destinationname,destinationID) {
    window.location.href = "destinationSite.php?name=" + encodeURIComponent(destinationname)+"&id=" + encodeURIComponent(destinationID);
    }
    </script> 
</body>
</html>