
if(isset($_POST['review_text']) && isset($_POST['rating'])) {
    $review_text = htmlspecialchars($_POST['review_text'], ENT_QUOTES, 'UTF-8');
    $rating = htmlspecialchars($_POST['rating'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO destination_reviews (destination_id, user_id, review_text, rating, review_date)
            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $destinationID, $user_id, $review_text, $rating, $date);
    $stmt->execute();

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
        echo "<h3 class='username'>" . htmlspecialchars($row['username'],ENT_QUOTES) . "</h3>";
        echo "<p class='review-text'>" . htmlspecialchars($row['review_text'],ENT_QUOTES) . "</p>";
        echo "<div class='rating'>" . htmlspecialchars($row['rating'],ENT_QUOTES) . "</div>";
        echo "<div class='review-date'>" . htmlspecialchars($row['review_date'],ENT_QUOTES) . "</div>";
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