<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}

require 'db_connection.php';
$student_id = $_SESSION['student_id'];
$msg = "";
$err = "";

// Form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = trim($_POST['current_password']);
    $new = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    // Fetch hashed password from DB
    $stmt = $conn->prepare("SELECT password FROM student_login WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

    // Verify current password
    if (!password_verify($current, $stored_password)) {
        $err = "❌ Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $err = "❌ New passwords do not match.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $new)) {
        $err = "❌ Password must be at least 8 characters, include 1 uppercase, 1 lowercase, and 1 digit.";
    } else {
        $hashed_new = password_hash($new, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE student_login SET password = ? WHERE student_id = ?");
        $update->bind_param("ss", $hashed_new, $student_id);
        if ($update->execute()) {
            $msg = "✅ Password updated successfully.";
        } else {
            $err = "❌ Failed to update password.";
        }
        $update->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        h2 { color: #2c3e50; margin-bottom: 20px; }
        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #6c63ff;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #514bdc;
        }
        .message {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .note {
            font-size: 13px;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Change Password</h2>
    <form method="post">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <input type="submit" value="Update Password">
    </form>

    <?php if ($msg): ?><p class="message"><?= $msg ?></p><?php endif; ?>
    <?php if ($err): ?><p class="error"><?= $err ?></p><?php endif; ?>

    <p class="note">🔒 Password must be at least <strong>8 characters</strong>, contain at least <strong>1 uppercase</strong>, <strong>1 lowercase</strong>, and <strong>1 number</strong>.</p>
</div>
</body>
</html>
