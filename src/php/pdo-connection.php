<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "findmeabreak";

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