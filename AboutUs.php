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
    <title>About Us</title>
    <link rel="stylesheet" href="src/css/aboutUs.css">
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
    <div class="aboutBanner"></div>
    <div class="about-container">
        <h1>About Us</h1>
        <div class="about-text">
            <p>FindMeABreak is a website dedicated to helping college students plan their spring break trips. Our goal is to make it easy for students to find out when their school's spring break is, and to suggest popular destinations that are within driving distance.</p>
            <p>Our team consists of travel enthusiasts who have visited many of the destinations we suggest. We are passionate about helping students have a safe and enjoyable spring break experience.</p>
            <p>Thank you for using FindMeABreak. We hope you find our website helpful in planning your next adventure!</p>
        </div>
    </div>
    <?php include "src/php/footer.php"; ?> 
</body>
</html>