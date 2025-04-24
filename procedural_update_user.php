<?php
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: procedural_login.php");
    exit;
}

require 'procedural_db.php';

if (!isset($_GET['id'])) {
    die("No user ID specified.");
}

$id = $_GET['id'];

// Fetch current username and password of the user to be updated
$query = "SELECT username, password FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle username update after password verification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $currentPassword = trim($_POST['password']);

    // Validate password
    if (password_verify($currentPassword, $user['password'])) {
        if (!empty($newUsername)) {
            // Use prepared statement to avoid SQL injection
            $updateQuery = "UPDATE users SET username = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "si", $newUsername, $id);
            mysqli_stmt_execute($updateStmt);

            // Redirect after successful update
            header("Location: procedural_dashboard.php");
            exit;
        } else {
            $error = "Username cannot be empty.";
        }
    } else {
        $error = "Incorrect password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Username</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00bcd4, #4caf50);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 300px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: none;
            border-radius: 5px;
            background: #eee;
            color: #000;
        }

        input[type="submit"] {
            background: #00bcd4;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background: #0097a7;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #fff;
            text-decoration: underline;
        }

        .error {
            color: #ff5252;
            margin-top: 10px;
        }

        .success {
            color: #4caf50;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>UPDATE </h2>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($successMessage)): ?>
        <div class="success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <input type="password" name="password" placeholder="Enter your password to confirm" required>
        <input type="submit" value="Update Username">
    </form>
    <a href="procedural_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
