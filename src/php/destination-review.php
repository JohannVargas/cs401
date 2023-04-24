<!DOCTYPE html>
<?php 
include_once('dbh.inc.php');
session_start();

$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
}

$destinationID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT destinations.destinationname, states.statename
FROM destinations
JOIN states ON destinations.stateID = states.stateID
WHERE destinations.destinationID = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $destinationID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$destinationname = $row['destinationname'];
$statename = $row['statename'];

$sql = "SELECT destination_reviews.*, users.username
FROM destination_reviews
JOIN users ON destination_reviews.user_id = users.id
WHERE destination_reviews.destination_id = ?
ORDER BY destination_reviews.review_date DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $destinationID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(isset($_POST['review_text']) && isset($_POST['rating'])) {
    $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $sql = "INSERT INTO destination_reviews (destination_id, user_id, review_text, rating, review_date)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iisis", $destinationID, $user_id, $review_text, $rating, $date);
    mysqli_stmt_execute($stmt);

    header('Location: '.$_SERVER['PHP_SELF'].'?id='.$destinationID);
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
    <h1 class="heading"><?php echo htmlspecialchars($destinationname, ENT_QUOTES, 'UTF-8'); ?> Reviews</h1>
    <h2 class="heading"><?php echo htmlspecialchars($statename, ENT_QUOTES, 'UTF-8'); ?></h2>
    <ul class="reviews-list">
    <?php 
    if (mysqli_num_rows($result) == 0) {
      echo "<p>No reviews yet. Be the first one to write a review!</p>";
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='review'>";
        echo "<h3 class='username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</h3>";
        echo "<p class='review-text'>" . htmlspecialchars($row['review_text'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<div class='rating'>" . htmlspecialchars($row['rating'], ENT_QUOTES, 'UTF-8') . "</div>";
        echo "<div class='review-date'>" . htmlspecialchars($row['review_date'], ENT_QUOTES, 'UTF-8') . "</div>";
        echo "</li>";
      }
    }
    ?>
    </ul>
      <?php if (!empty($username)): ?>
      <h2 class="heading">Submit a Review</h2>
      <form class="review-form" action="" method="POST">
        <input type="hidden" name="college_id" value="<?php echo htmlspecialchars($destinationID, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="form-group">
          <label for="review_text">Review:</label>
          <textarea name="review_text" id="review_text" rows="5" cols="30" class="form-control"><?php echo isset($_POST['review_text']) ? htmlspecialchars($_POST['review_text'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>
        <div class="form-group">
          <label for="rating">Rating:</label>
          <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" value="<?php echo isset($_POST['rating']) ? htmlspecialchars($_POST['rating'], ENT_QUOTES, 'UTF-8') : ''; ?>">
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