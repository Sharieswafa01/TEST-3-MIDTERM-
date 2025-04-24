<?php 
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: procedural_login.php");
    exit;
}

// Database connection
require 'procedural_db.php';

// Fetch all users' usernames
$query = "SELECT id, username FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00bcd4, #4caf50); /* Consistent gradient */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
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
            background-color: #00bcd4; /* Matched color */
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        a:hover, button:hover {
            background-color: #0097a7;
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
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    <p>You are now logged into the Procedural dashboard.</p>

    <h3>User Accounts</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td>
                        <a href="procedural_update_user.php?id=<?php echo $user['id']; ?>">UPDATE</a>
                        <a href="procedural_delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="procedural_logout.php" class="logout">LOGOUT</a>
</div>

</body>
</html>
