<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['id'];

// Connect to the database
include_once('src/php/dbh.inc.php');

// Get all the reviews made by the current user
$sql = "SELECT college_reviews.*, collegelist.name AS college_name FROM college_reviews
        INNER JOIN collegelist ON college_reviews.college_id = collegelist.ID
        WHERE college_reviews.user_id = '$user_id'
        ORDER BY college_reviews.review_date DESC";
$result = $conn->query($sql);

$sql2 = "SELECT destination_reviews.*, destinations.destinationname AS destination_name FROM destination_reviews
        INNER JOIN destinations ON destination_reviews.destination_id = destinations.destinationID
        WHERE destination_reviews.user_id = '$user_id'
        ORDER BY destination_reviews.review_date DESC";
        $result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="stylesheet" href="src/css/profile.css">
</head>
<body>
<?php 
    include "src/php/logged-in-nav.php";
  ?>
    <div class="Banner"></div>

    <div class="container">
        <div class="profile-banner"></div>

        <div class="profile-content">
            <h1 class="profile">Welcome, <?php echo $username; ?>!</h1>

            <div class="profile-info">
                <p class="profile-info-item"><strong>Username:</strong> <?php echo $username; ?></p>
                <p class="profile-info-item"><strong>Email:</strong> <?php echo $email; ?></p>
                <p><a href="src/php/logout.php">Logout</a></p>
                <p class="profile-info-item"><a href="src/php/update.php">Update information</a></p>
                <p class="profile-info-item"><a href="src/php/delete.php">Delete account</a></p>
            </div>

            <h2 class="profile-section-title">Your College Reviews</h2>
            <ul class="profile-reviews-list specific-list">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li class="profile-review-item">
                        <div class="profile-review-header">
                            <h3 class="profile-review-college-name"><?php echo $row['college_name']; ?></h3>
                            <p class="profile-review-date"><?php echo $row['review_date']; ?></p>
                        </div>
                        <p class="profile-review-text"><?php echo $row['review_text']; ?></p>
                        <p class="profile-review-rating"><strong>Rating:</strong> <?php echo $row['rating']; ?></p>
                    </li>
                <?php } ?>
            </ul>
            <h2 class="profile-section-title">Your Destination Reviews</h2>
            <ul class="profile-reviews-list specific-list">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <li class="profile-review-item">
                        <div class="profile-review-header">
                            <h3 class="profile-review-college-name"><?php echo $row2['destination_name']; ?></h3>
                            <p class="profile-review-date"><?php echo $row2['review_date']; ?></p>
                        </div>
                        <p class="profile-review-text"><?php echo $row2['review_text']; ?></p>
                        <p class="profile-review-rating"><strong>Rating:</strong> <?php echo $row2['rating']; ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <?php include "src/php/footer.php"; ?>

</body>
</html>

<?php
$conn->close();
?>
