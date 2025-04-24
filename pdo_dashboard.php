<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: pdo_login.php");
    exit;
}

require 'pdo_db.php';

$stmt = $pdo->query("SELECT id, username FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDO User Dashboard</title>
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

        .dashboard {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            width: 80%;
            max-width: 700px;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #fff;
        }

        a, button {
            color: #fff;
            background-color: #2196f3;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        a:hover, button:hover {
            background-color: #1976d2;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
            background-color: #f44336;
        }

        .logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <p>You are now logged into the PDO dashboard.</p>
    <h3>User Accounts</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td>
                        <a href="pdo_update_user.php?id=<?php echo $user['id']; ?>">UPDATE</a>
                        <a href="pdo_delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="pdo_logout.php" class="logout">LOGOUT</a>
</div>

</body>
</html>
