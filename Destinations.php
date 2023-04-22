<?php
session_start();

require_once "src/php/dbh.inc.php";

$username = '';
$state = '';

if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    if (isset($_SESSION['state'])) {
        $state = $_SESSION['state'];
    }
}

$destinations = array();

if (!empty($state)) {
    $stateID_query = "SELECT stateID FROM states WHERE statename='$state';";
    $stateID_result = mysqli_query($conn, $stateID_query);
    if ($stateID_result && mysqli_num_rows($stateID_result) > 0) {
        $stateID_row = mysqli_fetch_assoc($stateID_result);
        $stateID = $stateID_row['stateID'];

        $destinations_query = "SELECT destinationname, destination_description FROM destinations WHERE stateID='$stateID';";
        $destinations_result = mysqli_query($conn, $destinations_query);
        while ($destination_row = mysqli_fetch_assoc($destinations_result)) {
            array_push($destinations, $destination_row);
        }
    } else {
        // handle the case where the query returned no rows or an error occurred
        // for example, you can set a default value for $stateID or display an error message
        $stateID = 'ID'; // set a default value for $stateID
        // display an error message to the user
        echo "An error occurred while retrieving the state information.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Destinations Near You</title>
    <link rel="stylesheet" href="src/css/destinations.css">
    <link rel="stylesheet" href="src/css/styles.css">
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
    <h1 class="page-title">Best Destinations Around You</h1>
    <div class="page-description">
        <?php if (!empty($state)) { ?>
        <p>You are located in <?php echo $state; ?>.</p>
        <?php } else { ?>
        <p>Please log in to access your location information.</p>
        <?php } ?>
        <p>Find your next adventure with our list of the best destinations around you! We've curated a list of top picks based on your current location to help you discover new places and make the most of your travels. Whether you're looking for a relaxing getaway or an action-packed trip, we've got you covered.</p>
    </div>
    <div class="destination-container">
        <?php foreach ($destinations as $destination) { ?>
        <div class="destination">
            <a href="src/php/destinationSite.php">
                <div class="destination-image"></div>
                <h2><?php echo $destination['destinationname']; ?></h2>
            </a>
            <p><?php echo $destination['destination_description']; ?></p>
        </div>
        <?php } ?>
    </div>
</body>
</html>