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

    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="stylesheet" href="src/css/aboutUS.css">

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
    <div class=pillars>
    <p>Comprehensive information: FindMeABreak provides in-depth information on popular destinations, including details about local attractions, dining options, and lodging recommendations. This information is designed to help students make informed decisions about where to go and what to do on their spring break trip.</p>
    <p>Budget-friendly options: We understand that college students are often on a tight budget, which is why we prioritize suggesting destinations that are affordable and offer value for money. We also provide tips on how to save money on transportation, lodging, and other travel expenses.</p>  
    <p>Safety and security: At FindMeABreak, we prioritize the safety and security of our users. We provide information on safe travel practices, as well as advice on how to avoid common scams and dangers that may arise during spring break trips.</p>
    <p>Community engagement: FindMeABreak is more than just a website – it's a community of travel enthusiasts who are passionate about helping students have a great spring break experience. We encourage our users to share their travel experiences, tips, and recommendations with others in the community.</p>
  </div>
  <div>
  <p class="feedback">For any questions or feedback, please feel free to contact us at <a href="mailto:johannvargas767@u.boisestate.edu">johannvargas767@u.boisestate.edu</a></p>
  </div>  
  <?php include "src/php/footer.php"; ?> 
</body>
</html>