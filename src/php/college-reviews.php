<!DOCTYPE html>
<?php
include_once('dbh.inc.php');
session_start();
$username = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
}

$collegeID = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');

$sql = "SELECT name FROM collegelist WHERE ID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $collegeID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$collegeName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');

if(isset($_POST['review_text']) && isset($_POST['rating'])) {
    $review_text = htmlspecialchars($_POST['review_text'], ENT_QUOTES, 'UTF-8');
    $rating = htmlspecialchars($_POST['rating'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $sql = "INSERT INTO college_reviews (college_id, user_id, review_text, rating, review_date)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $collegeID, $user_id, $review_text, $rating, $date);
    mysqli_stmt_execute($stmt);

    header('Location: '.$_SERVER['PHP_SELF'].'?id='.$collegeID);
    exit();
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
        $sql = "SELECT college_reviews.*, users.username
                FROM college_reviews
                JOIN users ON college_reviews.user_id = users.id
                WHERE college_reviews.college_id = '$collegeID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
          echo "<p>No reviews yet. Be the first one to write a review!</p>";
        }
        else{
        while ($row = mysqli_fetch_assoc($result)) {
           echo "<li class='review'>";
          echo "<h3 class='username'>" . htmlspecialchars($row['username'], ENT_QUOTES) . "</h3>";
          echo "<p class='review-text'>" . htmlspecialchars($row['review_text'], ENT_QUOTES) . "</p>";
          echo "<div class='rating'>" . htmlspecialchars($row['rating'], ENT_QUOTES) . "</div>";
          echo "<div class='review-date'>" . htmlspecialchars($row['review_date'], ENT_QUOTES) . "</div>";
          echo "</li>";
        }
      }
        ?>
      </ul>
      <?php if (!empty($username)): ?>
      <h2 class="heading">Submit a Review</h2>
      <form class="review-form" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$collegeID; ?>" method="POST">
        <input type="hidden" name="college_id" value="<?php echo htmlspecialchars($collegeID); ?>">
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