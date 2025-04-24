<?php
session_start();
require_once 'classes/DB.php';

if (!isset($_GET['id'])) {
    header("Location: oop_dashboard.php");
    exit();
}

$db = new DB();
$id = $_GET['id'];
$user = $db->getUserById($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $password = $_POST['password'];

    if ($db->verifyPassword($id, $password)) {
        $db->updateUsername($id, $newUsername);
        header("Location: oop_dashboard.php");
        exit();
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
            padding: 20px;
            margin: 0;
        }

        .update-form {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px; /* Reduced size for the container */
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        input {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #fff;
            background-color: #fff;
            color: #333; /* Text color inside the input */
            font-size: 1rem;
        }

        button {
            color: #fff;
            background-color: #00bcd4;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #0097a7;
            transform: translateY(-2px);
        }

        a {
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
            font-size: 1rem;
            transition: opacity 0.3s ease;
        }

        a:hover {
            opacity: 0.7;
        }

        .error {
            color: red;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="update-form">
    <h2>Update Username</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        <input type="password" name="password" placeholder="Enter your password to confirm" required><br>
        <button type="submit">Update</button>
    </form>
    <br><a href="oop_dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
