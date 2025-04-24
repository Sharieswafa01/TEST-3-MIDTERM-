<?php
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: procedural_login.php");
    exit;
}

require 'procedural_db.php';

if (isset($_GET['id'])) {
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    mysqli_stmt_execute($stmt);
}

header("Location: procedural_dashboard.php");
exit;
?>
