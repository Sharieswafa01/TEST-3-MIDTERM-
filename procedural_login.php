<?php
include 'procedural_db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id();
        $_SESSION['user'] = $user['username'];
        header("Location: procedural_dashboard.php");
        exit;
    } else {
        $message = "❌ Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Procedural Login</title>
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
            text-align: center;
            animation: fadeIn 0.5s ease;
            position: relative;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #fff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        input {
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            width: 100%;
        }

        input:focus {
            border-color: #0072ff;
            outline: none;
        }

        button {
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
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

        a {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            transition: opacity 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            opacity: 0.8;
        }

        .back-arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 60px; /* Large arrow */
            font-weight: bold;
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
        <h2>Procedural Login</h2>
        <input name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button>Login</button>
    </form>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>
    
    <a href="procedural_register.php">Create Account</a>
</div>

</body>
</html>
