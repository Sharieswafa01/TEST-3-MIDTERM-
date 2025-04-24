<?php
// pdo_db.php

$host     = 'localhost';
$db       = 'pdo_login_db';
$user     = 'root';
$pass     = ''; // Use your MySQL root password if set
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // More secure and production-friendly error message
    error_log('Database Connection Error: ' . $e->getMessage());
    exit('A database error occurred. Please try again later.');
}
?>
