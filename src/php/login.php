<?php
    session_start();
    function get_state_from_ip($ip) {
        // Sanitize $ip input
        $sanitized_ip = htmlspecialchars($ip, ENT_QUOTES);
        $urls = array(
            "http://ip-api.com/json/$sanitized_ip",
            "http://freegeoip.app/json/$sanitized_ip"
        );
    
        foreach ($urls as $url) {
            $data = @file_get_contents($url);
            if ($data !== false) {
                $json = json_decode($data, true);
                if (isset($json['region']) && !empty($json['region'])) {
                    return $json['region'];
                }
            }
        }
    
        // If no state is found, return null or an error message.
        return null;
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
    // Retrieve form data and sanitize inputs
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
    require 'pdo-connection.php';
    // Check if username exists
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['username'] = htmlspecialchars($user['username'], ENT_QUOTES);
        $_SESSION['email'] = htmlspecialchars($user['email'], ENT_QUOTES);
        $_SESSION['id'] = htmlspecialchars($user['id'], ENT_QUOTES);
        $hostname = 'api.ip2location.com';
        $ip = gethostbyname($hostname);
        if ($ip === $hostname) {
            echo 'Invalid hostname';
        } else {
            // Call get_state_from_ip() function with $ip
            $state = get_state_from_ip($ip);
            $_SESSION['state'] = htmlspecialchars($state, ENT_QUOTES);
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
      <p><?php echo htmlspecialchars($errorMsg, ENT_QUOTES); ?></p>
    <?php } ?>
  </div>
    <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : ''; ?>" required>
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
<?php include "footer.php";