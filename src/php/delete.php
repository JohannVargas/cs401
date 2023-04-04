<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteConfirmed = $_POST['delete-confirmed'] ?? false;

    if ($deleteConfirmed) {
        require 'pdo-connection.php';
        $stmt = $pdo->prepare('DELETE FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        session_unset();
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <link rel="stylesheet" href="../css/delete.css">
</head>
<body>
    <div class="container">
        <h1>Delete Account</h1>
        <p class="message">Are you sure you want to delete your account? This action cannot be undone.</p>
        <form method="post" action="">
            <p>
                <input type="checkbox" name="delete-confirmed" id="delete-confirmed" required>
                <label for="delete-confirmed">I confirm that I want to delete my account.</label>
            </p>
            <p>
                <input type="submit" value="Delete Account">
            </p>
        </form>
        <button class="back-btn" onclick="window.location.href='../../profile.php'">Back to Profile</button>
    </div>
</body>
</html>