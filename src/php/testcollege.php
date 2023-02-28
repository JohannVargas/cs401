<!DOCTYPE html>
<?php include_once('dbh.inc.php')?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>University Details</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/collegeSite.css">
  <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

  <div class="container">
  <?php
// Retrieve the ID of the college from the URL parameter
$collegeID = $_GET['id'];

// Retrieve information about the selected college
$sql = "SELECT collegelist.*, states.statename
        FROM collegelist
        JOIN states ON collegelist.stateID = states.stateID
        WHERE collegelist.ID = '$collegeID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Retrieve the row of data from the query
    $row = mysqli_fetch_assoc($result);

    // Display the name of the college and state on the page
    echo "<h1>" . $row['name'] . "</h1>";
    echo "<h2>" . $row['statename'] . "</h2>";

    // Retrieve destinations associated with the state
    $stateID = $row['stateID'];
    $sql = "SELECT * FROM destinations WHERE stateID = '$stateID' LIMIT 4";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display the destinations
        echo "<h3>Destinations:</h3>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['destinationname'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No destinations found for the selected state";
    }
} else {
    echo "No college found with the specified ID";
}
?>
</body>
</html>