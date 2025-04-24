<?php
include 'pdo_db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id();
        $_SESSION['user'] = $user['username'];
        header("Location: pdo_dashboard.php");
        exit;
    } else {
        $message = "❌ Login failed. Please check your credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDO Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #00bcd4, #4caf50);
    display: flex;
    justify-content: center;
    align-items: center; /* Changed from flex-start to center */
    min-height: 100vh;
    padding: 20px;
}


        .card {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.5s ease;
            position: relative;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        input {
            padding: 14px;
            font-size: 16px;
            border-radius: 10px;
            border: none;
            outline: none;
            background-color: #f9f9f9;
        }

        input:focus {
            border: 2px solid #4caf50;
        }

        button {
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        button:hover {
            background-color: #43a047;
            transform: translateY(-2px);
        }

        .message {
            margin-top: 20px;
            background: #e6ffed;
            color: #2f7a3e;
            border-left: 6px solid #4caf50;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }

        .logout-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #ffffff;
            font-weight: bold;
            text-decoration: underline;
        }

        .logout-link:hover {
            text-decoration: none;
            opacity: 0.8;
        }

        .back-arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 60px; /* Increased size */
            font-weight: bold; /* Made the arrow bolder */
            color: #ffffff;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .back-arrow:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>

<a href="index.php" class="back-arrow">←</a>

<div class="card">
    <form method="post">
        <h2>PDO Login</h2>
        <input name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button>Login</button>
    </form>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>
    
    <a class="logout-link" href="pdo_register.php">Create Account</a>
</div>

</body>
</html>
