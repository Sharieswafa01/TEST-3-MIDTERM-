<?php
session_start();
require_once 'classes/DB.php';

if (!isset($_SESSION['username'])) {
    header('Location: oop_login.php');
    exit();
}

$db = new DB();
$users = $db->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Dashboard</title>
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

        .dashboard {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: relative;
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 20px;
        }

        h3 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            border: 1px solid #fff;
            text-align: left;
        }

        th {
           
        }

        td {
            
        }

        td a {
            color: #fff;
            background-color: #00bcd4; /* Matched color */
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        td a:hover {
            background-color: #0097a7;
            transform: translateY(-2px);
        }

        .logout {
            margin-top: 30px;
            display: inline-block;
            background-color: #f44336;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            color: white; /* Make logout text white */
        }

        .logout:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 30px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: opacity 0.3s ease;
        }

        .back-link:hover {
            opacity: 0.7;
        }

        /* Center the buttons */
        td {
            text-align: center; /* Center the buttons in each table row */
        }

        /* Responsive Design for smaller screens */
        @media (max-width: 600px) {
            .dashboard {
                padding: 20px;
                max-width: 90%;
            }

            h2 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1.2rem;
            }

            th, td {
                padding: 10px;
            }

            td a {
                padding: 6px 12px;
                font-size: 0.9rem;
            }

            .logout {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

<a href="index.php" class="back-link">←</a>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You are now logged into the OOP dashboard.</p>
    <h3>User List</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <a href="oop_update.php?id=<?php echo $row['id']; ?>">UPDATE</a>
                        <a href="oop_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="logout.php" class="logout">LOGOUT</a>
</div>

</body>
</html>
