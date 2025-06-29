<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_login WHERE Admin_ID = ? AND Password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $admin_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['admin_id'] = $admin_id;

        // Optional: log the login
        $mysqli->query("INSERT INTO log (action) VALUES ('Admin $admin_id logged in')");

        header("Location: dashboard_admin.php");
        exit();
    } else {
        $error = "Invalid Admin ID or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-container {
            width: 350px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-container img {
            width: 80px;
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        input[type="text"], input[type="password"] {
            width: 85%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 20px;
        }
        button {
            width: 90%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
        .error {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <img src="assets/admin.png" alt="Admin">
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="text" name="admin_id" placeholder="Admin ID" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>
</body>
</html>
