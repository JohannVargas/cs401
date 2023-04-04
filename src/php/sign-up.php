<?php

session_start();
function get_state_from_ip($ip) {
    $url = "http://ip-api.com/json/$ip";
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    return $json['region'];
}
if (isset($_SESSION['username'])) {
    // Redirect user to home page if already logged in
    header('Location: ../../index.php');
    exit();
}
$errorMsg = '';
$username = '';
$password = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $isValid = true;

    if (empty($username)) {
        $errorMsg .= 'Please enter a username.<br>';
        $isValid = false;
    }
    if (empty($password)) {
        $errorMsg .= 'Please enter a password.<br>';
        $isValid = false;
    }
    if (empty($email)) {
        $errorMsg .= 'Please enter an email address.<br>';
        $isValid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= 'Please enter a valid email address.<br>';
        $isValid = false;
    }

    // Regex validation for username
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        $errorMsg .= 'Username can only contain letters, numbers, hyphens and underscores.<br>';
        $isValid = false;
    }

    if ($isValid) {
        require 'pdo-connection.php';
        // Check if username already exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $errorMsg = 'Username already exists. Please choose another one.';
        } else {
            // Check if email already exists
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $errorMsg = 'Email already exists. Please use a different email address.';
            } else {
                // Insert user into database
                $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user_id = $pdo->lastInsertId();
                // Set session variables
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $user_id;
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
                header('Location: login.php');
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/sign-up.css">
</head>
<body>
    <?php include "nav2.php"; ?>
    <div class="Banner"></div>
    <div class="FormWrapper">
        <h1>Sign Up</h1>
        <?php if (!empty($errorMsg)) { ?>
            <p class="Error"><?php echo $errorMsg; ?></p>
        <?php } ?>
        <form method="post" action="" class="Form">
            <div class="FormRow">
                <label for="username" class="FormLabel">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required class="FormInput">
            </div>
            <div class="FormRow">
                <label for="password" class="FormLabel">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>" required class="FormInput">
            </div>
            <div class="FormRow">
                <label for="email" class="FormLabel">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required class="FormInput">
            </div>
            <div class="FormRow">
                <input type="submit" value="Sign Up" class="FormButton">
                
            </div>
        </form>
    </div>
    <?php include "footer.php"; ?>  
</body>
</html>