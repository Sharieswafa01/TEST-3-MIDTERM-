<?php 
require 'pdo_db.php';

if (!isset($_GET['id'])) {
    die("No user ID specified.");
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Verify the user's password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }

    // Check if the password is correct
    if (password_verify($password, $user['password'])) {
        if ($newUsername !== '') {
            // Update the username
            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->execute([$newUsername, $id]);
            $successMessage = "Username successfully updated!";
        }
    } else {
        $error = "Incorrect password. Please try again.";
    }
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Username - PDO</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #009688;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: white;
        }

        .form-container {
            background: rgba(0,0,0,0.7);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 300px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #fff;
            text-decoration: underline;
        }

        input[type="submit"]:hover {
            background: #388e3c;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Username</h2>
    
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <?php if (isset($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
    
    <form method="POST">
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <input type="password" name="password" placeholder="Enter your password to confirm" required>
        <input type="submit" value="Update Username">
    </form>
    <a href="pdo_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
