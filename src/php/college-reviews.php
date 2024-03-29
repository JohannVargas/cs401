<?php
include_once 'dbh.inc.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}

$username = $_SESSION['username'];
$collegeID = mysqli_real_escape_string($conn, $_GET['id']);

// Sanitize college ID input
if (!ctype_digit($collegeID)) {
  header('Location: error.php');
  exit();
}

// Retrieve college name
$sql = "SELECT name FROM collegelist WHERE ID = '$collegeID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$collegeName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
  $rating = (int) $_POST['rating'];

  // Sanitize review and rating inputs
  $review_text = htmlspecialchars($review_text, ENT_QUOTES, 'UTF-8');
  $rating = filter_var($rating, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 5)));

  // Validate input
  if (empty($review_text) || $rating === false) {
    $error = 'Please enter a valid review and rating.';
  } else {
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');

    // Insert review into database
    $sql = "INSERT INTO college_reviews (college_id, user_id, review_text, rating, review_date)
            VALUES ('$collegeID', '$user_id', '$review_text', '$rating', '$date')";
    mysqli_query($conn, $sql);

    // Redirect to same page
    header('Location: '.$_SERVER['PHP_SELF'].'?id='.$collegeID);
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($collegeName); ?> Reviews</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/reviews.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/collegeSite.css">
  </head>
  <body>
    <?php include (!empty($username) ? 'logged-in-nav.php' : 'nav2.php'); ?>
    <div class="Banner"></div>
    <div class="container">
      <h1 class="heading"><?php echo htmlspecialchars($collegeName); ?> Reviews</h1>
      <ul class="reviews-list">
        <?php
        $collegeID_sanitized = mysqli_real_escape_string($conn, $collegeID);
        $sql = "SELECT college_reviews.*, users.username
                FROM college_reviews
                JOIN users ON college_reviews.user_id = users.id
                WHERE college_reviews.college_id = '$collegeID_sanitized'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
          echo "<p>No reviews yet. Be the first one to write a review!</p>";
        }
        else{
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<li class='review'>";
          echo "<h3 class='username'>" . htmlspecialchars($row['username']) . "</h3>";
          echo "<p class='review-text'>" . htmlspecialchars($row['review_text']) . "</p>";
          echo "<div class='rating'>" . htmlspecialchars($row['rating']) . "</div>";
          echo "<div class='review-date'>" . htmlspecialchars($row['review_date']) . "</div>";
          echo "</li>";
        }
      }
        ?>
      </ul>
      <?php if (!empty($username)): ?>
      <h2 class="heading">Submit a Review</h2>
      <form class="review-form" action="" method="POST">
        <input type="hidden" name="college_id" value="<?php echo htmlspecialchars($collegeID); ?>">
        <div class="form-group">
          <label for="review_text">Review:</label>
          <textarea name="review_text" id="review_text" rows="5" cols="30" class="form-control"><?php if(isset($_POST['review_text'])) echo htmlspecialchars($_POST['review_text']); ?></textarea>
        </div>
        <div class="form-group">
          <label for="rating">Rating:</label>
          <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" value="<?php if(isset($_POST['rating'])) echo htmlspecialchars($_POST['rating']); ?>">
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