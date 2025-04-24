<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(to right,  #00bcd4, #4caf50);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 60px 20px;
        }

        

        .card {
            background:rgba(0, 0, 0, 0.7);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2, h3 {
            text-align: center;
    margin: 0 0 20px;
    color: #fff; /* Changed to white */
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
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

        ul {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }

        li {
            background: #f9f9f9;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Create User</h2>

    <form method="post">
        <input type="text" name="username" required placeholder="Enter username">
        <input type="password" name="password" required placeholder="Enter password">
        <button name="create">Create Account</button>
    </form>

    <?php
    if (isset($_POST['create'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        echo "<div class='message'>✅ User <strong>{$username}</strong> created successfully!</div>";
    }

    $stmt = $pdo->query("SELECT id, username FROM users");
    echo "<h3>Existing Users</h3><ul>";
    while ($user = $stmt->fetch()) {
        echo "<li><strong>{$user['id']}</strong> — {$user['username']}</li>";
    }
    echo "</ul>";
    ?>
</div>

</body>
</html>
