<?php
include_once('dbh.inc.php');

print_r($_POST);

if(isset($_POST['search'])) {
    $search_query = $_POST['search'];
    print_r($search_query);

    $sql = "SELECT * FROM collegelist WHERE name LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td onclick='goToCollegeSite(\"".$row["name"]."\",".$row["ID"].")'>".$row ["name"]."</td><td>".$row["stateID"]."</td><td>".$row["date"]."</td></tr>";
        }
    } else {
        echo "no Response";
    }
}
?>