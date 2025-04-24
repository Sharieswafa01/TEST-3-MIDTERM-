<?php
$servername = "localhost";
$username = "root";         // Replace with your DB username
$password = "";             // Replace with your DB password
$dbname = "procedural_login_db"; // Replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection securely
if (!$conn) {
    // Log the error to a file for troubleshooting (ensure your server has permission to write to this file)
    error_log("Connection failed: " . mysqli_connect_error(), 3, "/var/log/php_errors.log");

    // Show a user-friendly error message
    die("⚠️ Unable to connect to the database at the moment. Please try again later.");
}

// Connection successful (optional for debugging)
// echo "Connected successfully";
?>
