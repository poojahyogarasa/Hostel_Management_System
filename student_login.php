<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $mysqli->prepare("SELECT * FROM student_login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['student_id'] = $row['student_id'];
            header("Location: dashboard_student.php");
            exit();
        } else {
            $error = "❌ Invalid password!";
        }
    } else {
        $error = "❌ No such user found!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
            width: 360px;
        }
        .login-box h2 {
            text-align: center;
            color: #0072ff;
            margin-bottom: 25px;
        }
        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        .login-box button {
            width: 100%;
            background: #0072ff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-box button:hover {
            background: #005bb5;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Student Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error)) echo "<p class='error'>" . htmlspecialchars($error) . "</p>"; ?>
    </div>
</body>
</html>
