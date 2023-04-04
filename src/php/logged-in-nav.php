<style>
<?php include '../css/nav.css'?>
</style>
<html>
    <head>
        <title>navbar</title>
    </head>
    <body>
    <nav class="navbar">
        <div class="content">
            <div class="logo"><a href="../../index.php">
                <img src="images/logo.png" alt="Logo">
            </a></div>
            <div class="search-bar">
                <input type="text" placeholder="e.g. when is ASU'S Spring break">
                <button type="submit">Go</button>
            </div>
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
        const body = document.querySelector("body");
        const navbar = document.querySelector(".navbar");
        const menu = document.querySelector(".menu-list");
        const menuBtn = document.querySelector(".menu-btn");
        const cancelBtn = document.querySelector(".cancel-btn");
        menuBtn.onclick = () => {
            menu.classList.add("active");
            menuBtn.classList.add("hide");
            cancelBtn.classList.add("show");
            body.classList.add("disabledScroll");
        }
        cancelBtn.onclick = () => {
            menu.classList.remove("active");
            menuBtn.classList.remove("hide");
            cancelBtn.classList.remove("show");
            body.classList.remove("disabledScroll");
        }

        window.onscroll = () => {
            this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
        }
    </script>
    </body>    
</html>
