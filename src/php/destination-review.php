<!DOCTYPE html>
<?php 
include_once('dbh.inc.php');
session_start();

$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
}

$destinationID = $_GET['id'];

$sql = "SELECT destinations.destinationname, states.statename
FROM destinations
JOIN states ON destinations.stateID = states.stateID
WHERE destinations.destinationID = '$destinationID'
";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$destinationname = $row['destinationname'];
$statename = $row['statename'];

$sql = "SELECT destination_reviews.*, users.username
FROM destination_reviews
JOIN users ON destination_reviews.user_id = users.id
WHERE destination_reviews.destination_id = '$destinationID'
ORDER BY destination_reviews.review_date DESC
";

$result = mysqli_query($conn, $sql);
if(isset($_POST['review_text']) && isset($_POST['rating'])) {
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $sql = "INSERT INTO destination_reviews (destination_id, user_id, review_text, rating, review_date)
            VALUES ('$destinationID', '$user_id', '$review_text', '$rating', '$date')";
    mysqli_query($conn, $sql);

    header('Location: '.$_SERVER['PHP_SELF'].'?id='.$collegeID);
    exit();
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Destination Reviews</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/reviews.css">
</head>
<body>
  <?php 
    if (!empty($username)) {
      include "logged-in-nav.php";
    } else {
      include "nav2.php";
    }
  ?>
  <div class="Banner"></div>
  <div class="container">
    <h1 class="heading"><?php echo $destinationname; ?> Reviews</h1>
    <h2 class="heading"><?php echo $statename; ?></p>
    <ul class="reviews-list">
    <?php 
    if (mysqli_num_rows($result) == 0) {
      echo "<p>No reviews yet. Be the first one to write a review!</p>";
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='review'>";
        echo "<h3 class='username'>" . $row['username'] . "</h3>";
        echo "<p class='review-text'>" . $row['review_text'] . "</p>";
        echo "<div class='rating'>" . $row['rating'] . "</div>";
        echo "<div class='review-date'>" . $row['review_date'] . "</div>";
        echo "</li>";
      }
    }
    ?>
    </ul>
      <?php if (!empty($username)): ?>
      <h2 class="heading">Submit a Review</h2>
      <form class="review-form" action="" method="POST">
        <input type="hidden" name="college_id" value="<?php echo $destinationID; ?>">
        <div class="form-group">
          <label for="review_text">Review:</label>
          <textarea name="review_text" id="review_text" rows="5" cols="30" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="rating">Rating:</label>
          <input type="number" name="rating" id="rating" min="1" max="5" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      <?php else: ?>
      <p class="message">Please <a href="login.php">log in</a> to submit a review.</p>
      <?php endif; ?>
  </div>
  <?php include "footer.php"; ?>  
</body>
</html>