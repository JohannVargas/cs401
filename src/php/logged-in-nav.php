<style>
    <?php include '../css/nav.css'?>
</style>
<html>
<head>
    <title>navbar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/functions.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="../../index.php">
                <img src="../../images/logo2.png" alt="Logo">
            </a></div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../../AboutUs.php">About</a></li>
                <li><a href="../../Colleges.php">Colleges</a></li>
                <li><a href="../../Destinations.php">Destinations</a></li>
                <li><a href="../../profile.php">My Profile</a></li>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <script>
        $(document).ready(function() {
  var body = $("body");
  var navbar = $(".navbar");
  var menu = $(".menu-list");
  var menuBtn = $(".menu-btn");
  var cancelBtn = $(".cancel-btn");

  menuBtn.click(function() {
      menu.addClass("active");
      menuBtn.addClass("hide");
      cancelBtn.addClass("show");
      body.addClass("disabledScroll");
  });

  cancelBtn.click(function() {
      menu.removeClass("active");
      menuBtn.removeClass("hide");
      cancelBtn.removeClass("show");
      body.removeClass("disabledScroll");
  });

  $(window).scroll(function() {
      this.scrollY > 20 ? navbar.addClass("sticky") : navbar.removeClass("sticky");
  });
});
    </script>
</body>
</html>