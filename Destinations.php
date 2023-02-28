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
    <?php include "src/php/nav.php";?>
    <div class="Banner"></div>
    <h1 class="page-title">Best Destinations Around You</h1>
    <div class="page-description">
        <p>Find your next adventure with our list of the best destinations around you! We've curated a list of top picks based on your current location to help you discover new places and make the most of your travels. Whether you're looking for a relaxing getaway or an action-packed trip, we've got you covered.</p>
    </div>
    <div class="destination-container">
        <div class="destination">
            <a href="src/php/destinationSite.php">
                <img src="src/images/destination1.jpg" alt="Destination 1">
                <h2>Destination 1</h2>
            </a>
        </div>
        <div class="destination">
                <img src="src/images/destination2.jpg" alt="Destination 2">
                <h2>Destination 2</h2>

        </div>
        <div class="destination">
                <img src="src/images/destination3.jpg" alt="Destination 3">
                <h2>Destination 3</h2>
        </div>
        <div class="destination">
                <img src="src/images/destination4.jpg" alt="Destination 4">
                <h2>Destination 4</h2>
        </div>
    </div>
</body>
</html>
