<?php
include 'procedural_db.php';

// Disable exception throwing to allow manual error handling
mysqli_report(MYSQLI_REPORT_OFF);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to login page after successful registration
        header("Location: procedural_login.php");
        exit;
    } else {
        // Check if error is duplicate entry
        if (mysqli_errno($conn) == 1062) {
            $message = "❌ Username already exists. Please choose another one.";
        } else {
            $message = "❌ Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
            align-items: center;
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
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            color: #fff;
            font-size: 24px;
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
            background: #ffdddd;
            color: #a94442;
            border-left: 6px solid #f44336;
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
    </style>
</head>
<body>

<div class="card">
    <form method="post">
        <h2>Create Account</h2>
        <input name="username" placeholder="Choose Username" required>
        <input type="password" name="password" placeholder="Choose Password" required>
        <button>Register</button>
    </form>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>
    <a class="logout-link" href="procedural_login.php">Back to Login</a>
</div>

</body>
</html>
