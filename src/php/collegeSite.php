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
  <link rel="stylesheet" href="../css/college-site.css">
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
  
  <?php 
      echo "<h1>".$row['name']."</h1>";
      echo "<h2>".$row['statename']."</h2>";?>
      <?php 
      $sql3 = "SELECT * FROM collegedetails WHERE collegeID = '$collegeID'";
      $result3 = mysqli_query($conn, $sql3);
      if ($result3 === false) {
        echo "Error: " . mysqli_error($conn);
    } else if(mysqli_num_rows($result3) > 0){
        $row3 = mysqli_fetch_assoc($result3);
        echo "<img src='".$row3['logo']."' alt='Logo' class='location-image'>";
        echo "<a href='college-reviews.php?id=".$collegeID."' class='reviews'>Reviews</a>";
        echo "<p class='description'>".$row3['description']."</p>";
      } else {
        echo "<p>Sorry, no college details available for ".$row['name'].".</p>";
        echo "<div><a href='college-reviews.php?id=".$collegeID."' class='reviews'>Reviews</a></div>";
      }
    ?>

  <?php
    while ($row2 = mysqli_fetch_assoc($result2)) {
      echo "<div class='destination'>";
      
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