<?php
$dbServername = "us-cdbr-east-06.cleardb.net";
$dbUsername = "bac890cd1d657c";
$dbPassword = "3f3da4cc";
$dbName = "heroku_4050c3bcd543143";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $dsn = "mysql:host={$dbServername};dbname={$dbName}";
    $pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>