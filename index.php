<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login System</title>
    <style>
        /* General body and background styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #00bcd4, #4caf50);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        /* Styling the main container */
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Header Styling */
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }

        /* Styling the list for buttons */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        /* Styling each link (button) */
        a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            width: 250px;
        }

        /* Hover effect on links */
        a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            a {
                width: 200px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Secure Login System</h1>
        <ul>
            
            <li><a href="pdo_login.php">PDO Login</a></li>
            <li><a href="procedural_login.php">Procedural Login</a></li>
            <li><a href="oop_login.php">OOP Login</a></li>
        </ul>
    </div>

</body>
</html>
