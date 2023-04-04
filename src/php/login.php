<?php
    session_start();
    function get_state_from_ip($ip) {
        $url = "http://ip-api.com/json/$ip";
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        return $json['region'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>



<?php

    if (isset($_SESSION['username'])) {
        // Redirect user to home page if already logged in
        header('Location: ../../index.php');
        exit();
    }
    $errorMsg = '';
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        require 'pdo-connection.php';
        // Check if username exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            $hostname = 'api.ip2location.com';
            $ip = gethostbyname($hostname);
            if ($ip === $hostname) {
                echo 'Invalid hostname';
            } else {
                // Call get_state_from_ip() function with $ip
                $state = get_state_from_ip($ip);
                $_SESSION['state'] = $state;
            }
            // Redirect to another page
            header('Location: ../../index.php');
            exit();
        } else {
        $errorMsg = 'Invalid username or password.';
        }
    }
?>

<form method="post" action="">
    <h1 >Login</h1>
    <div class="error-message">
    <?php if (!empty($errorMsg)) { ?>
      <p><?php echo $errorMsg; ?></p>
    <?php } ?>
  </div>
    <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </p>
    <p>
        <input type="submit" value="Login">
        <button onclick="window.location.href='../../index.php'">Back to Home</button>
    </p>
</form>
<?php include "footer.php"; ?>  
</body>
</html>