<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$errorMsg = '';
$username = $_SESSION['username'];
$password = '';
$new_username = '';
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $new_username = trim($_POST['username']);
    $isValid = true;

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
    if (empty($new_username)) {
        $errorMsg .= 'Please enter a new username.<br>';
        $isValid = false;
    }

    if ($isValid) {
        require 'pdo-connection.php';
        // Check if new username already exists in the database
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :new_username');
        $stmt->bindParam(':new_username', $new_username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $errorMsg .= 'Username already exists.<br>';
            $isValid = false;
        }

        if ($isValid) {
            // Update user information in database
            $stmt = $pdo->prepare('UPDATE users SET username = :new_username, password = :password, email = :email WHERE username = :username');
            $stmt->bindParam(':new_username', $new_username);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $_SESSION['username'] = $new_username;
            $_SESSION['email'] = $email;
            header('Location: ../../profile.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Information</title>
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>
    <div class="container">
        <h1>Update Information</h1>
        <form method="post" action="">
            <?php if (!empty($errorMsg)) { ?>
                <p class="error"><?php echo $errorMsg; ?></p>
            <?php } ?>
            <p>
                <label for="username">New Username:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" >
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>" >
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" >
            </p>
            <p>
                <input type="submit" value="Update Information">
                
            </p>
        </form>
        <button onclick="window.location.href='../../profile.php'">Back to Profile</button>
    </div>
</body>
</html>