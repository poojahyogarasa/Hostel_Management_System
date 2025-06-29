<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $date = date('Y-m-d');

    $stmt = $mysqli->prepare("INSERT INTO notifications (title, message, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $message, $date);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Notification sent successfully!'); window.location='dashboard_admin.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to send notification.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Notification</title>
    <style>
        body {
            background: linear-gradient(to right, #f3f4f6, #dbeafe);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 15px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: none;
        }
        textarea {
            height: 100px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3744a3;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>📢 Send Notification</h2>
        <form method="post" action="">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea>

            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
