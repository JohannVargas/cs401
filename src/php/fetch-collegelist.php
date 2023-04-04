<?php
include "dbh.inc.php";

if (isset($_GET['limit'])) {
  $limit = $_GET['limit'];
} else {
  $limit = 5;
}

$sql = "SELECT * FROM collegelist LIMIT $limit";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr><td onclick='goToCollegeSite(\"".$row["name"]."\",".$row["ID"].")'>".$row["name"]."</td><td>".$row["stateID"]."</td><td>".$row["date"]."</td></tr>";
  }
} else {
  echo "no Response";
}
mysqli_close($conn);
?>