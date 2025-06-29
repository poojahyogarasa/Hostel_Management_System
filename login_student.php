<?php
session_start();
require_once "config.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT student_id, password FROM student_login WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($student_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION["student_id"] = $student_id;
                header("Location: dashboard_student.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Username not found.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #d9e2ec);
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .card h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #2c3e50;
        }

        .logo {
            width: 80px;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #303f9f;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .back-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: #3f51b5;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <img src="assets/logo.png" alt="Student Logo" class="logo"> <!-- Corrected path -->
        <h2>Student Login</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <a href="index.php" class="back-link">← Back to Home</a>
    </div>
</div>

</body>
</html>
