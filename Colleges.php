<?php
session_start();

$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<?php include_once('src/php/dbh.inc.php')?>
<html lang="en">
<style>
  <?php include 'src/css/colleges.css'?>
  <?php include 'src/css/styles.css' ?>
</style>  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>colleges</title>
    <link rel="stylesheet" href="src/css/colleges.css">
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
<div class="Banner"></div>
<div class="about">
    <h1 class="welcome_text">WHEN IS MY SPRING BREAK? </h1>
    <p class="welcome_description">Ready to plan your 
        ultimate Spring Break getaway? Look no further than our comprehensive list of colleges and their Spring Break dates! Simply select your college from the list below and we'll show you all the dates you need to know to make the most of your vacation. Whether you're looking to party hard or soak up the sun in a relaxing destination, we've got you covered. So go ahead, start exploring and get ready for the best Spring Break ever!</p>
</div>

<div class="table-container">
    <h2 class="table-title">SPRING BREAK 2023 DATES</h2>
    <div class="search_bar">
    <form method="post">
        <input type="text" placeholder="e.g Boise State" name="collegeName">
        <button type="submit">Go</button>
        <select id="num_rows_select" name="limit">
            <option value="10" selected>10 Rows</option>
            <option value="25">25 Rows</option>
            <option value="50">50 Rows</option>
            <option value="1000">1000 Rows</option>
        </select>
    </form>
    </div>
    <table id="collegelistTable">
        <thead class="tablehead">
            <tr>
                <th>Name of College</th>
                <th>State</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="collegelistTableBody">
            <?php
            $limit = 10;
            if (isset($_GET["limit"])) {
                $limit = intval($_GET["limit"]);
            }
            $sql = "SELECT * FROM collegelist LIMIT " . $limit . ";";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td onclick='goToCollegeSite(\"".$row["name"]."\",".$row["ID"].")'>".$row ["name"]."</td><td>".$row["stateID"]."</td><td>".$row["date"]."</td></tr>";
                }
            } else {
                echo "no Response";
            }
            ?>
        </tbody>
    </table>
</div>
  <?php include "src/php/footer.php"; ?>  
    <?php include "src/php/footer.php"; ?>  
    <script>

$(document).ready(function() {
  $("button[type='submit']").click(function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      var collegeName = $("input[name='collegeName']").val();
$.ajax({
  type: "POST",
  url: "src/php/search-collegelist.php",
  data: { search: collegeName },
  success: function(data) {
      $("#collegelistTableBody").html(data);
  }
});
  });
});
$(document).ready(function() {
  const numRowsSelect = $('#num_rows_select');
  numRowsSelect.change(function() {
      const limit = this.value;
      const url = `src/php/fetch-collegelist.php?limit=${limit}`;
      $.get(url, function(data) {
          $('#collegelistTableBody').html(data);
      });
  });
});
    </script>    
</body>
</html>