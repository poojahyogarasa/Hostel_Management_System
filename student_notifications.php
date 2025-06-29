<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

require 'db.php';
$result = $mysqli->query("SELECT * FROM notifications ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #1a237e;
            margin-bottom: 30px;
        }
        .notification {
            background: #f9f9f9;
            padding: 20px;
            border-left: 6px solid #1a237e;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .notification h3 {
            margin: 0;
            font-size: 20px;
            color: #1a237e;
        }
        .notification p {
            margin: 10px 0 0;
            color: #333;
        }
        .notification small {
            display: block;
            text-align: right;
            color: #555;
            margin-top: 5px;
        }
        .back-btn {
            text-align: center;
            margin-top: 30px;
        }
        .back-btn a {
            text-decoration: none;
            padding: 10px 25px;
            background-color: #1a237e;
            color: white;
            border-radius: 6px;
        }
        .back-btn a:hover {
            background-color: #0d144a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📢 Notifications</h2>

        <?php while($row = $result->fetch_assoc()): ?>
            <div class="notification">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                <small>📅 <?= $row['date'] ?></small>
            </div>
        <?php endwhile; ?>

        <div class="back-btn">
            <a href="dashboard_student.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
