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
    <link rel="stylesheet" href="src/css/front-page.css">
    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="src/js/functions.js"></script>
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
  <div class="destination-box destination">
  <a href="https://aqueous-shore-82560.herokuapp.com/src/php/collegeSite.php?name=Arizona%20State%20University&id=24">
    <img src="images/ASU-logo.png" alt="Destination 1">
  </a>
  <h3>Arizona State University</h3>
</div>
  <div class="destination-box destination">
  <a href="https://aqueous-shore-82560.herokuapp.com/src/php/collegeSite.php?name=Boise%20State%20University&id=68">
    <img src="images/BSU-logo.png" alt="Destination 2">
  </a>
    <h3>Boise State University</h3>
  </div>
  <div class="destination-box destination">
  <a href="https://aqueous-shore-82560.herokuapp.com/src/php/collegeSite.php?name=University%20of%20Idaho&id=767">
    <img src="images/UI-logo.png" alt="Destination 3">
  </a>
    <h3>University of Idaho</h3>
  </div>
  <div class="destination-box destination">
  <a href="https://aqueous-shore-82560.herokuapp.com/src/php/collegeSite.php?name=Washington%20State%20University-Pullman&id=908">  
  <img src="images/WSU-logo.png" alt="Destination 4">
  </a>
    <h3>Washington State Universitys</h3>
  </div>
</div>


  <?php include "src/php/footer.php"; ?> 
  <script>
$(document).ready(function() {
  // Add mouseover effect to destination boxes
  $('.destination').mouseenter(function() {
    $(this).stop().animate({
      width: '23%',
      height: '300px',
      left: '50%',
      top: '50%',
      marginleft: '-150px',
      marginTop: '-150px',
      border: '2px solid #0066cc'
    }, 500);
  });
  $('.destination').mouseleave(function() {
    $(this).stop().animate({
      width: '23%', 
      left: 'initial',
      top: 'initial',
      marginTop: '0',
      marginbottom: '10px'
    }, );
  });
});
</script>

</body>
</html>