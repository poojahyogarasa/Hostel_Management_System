<?php
require 'db.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if student_id exists in students table
    $stmt = $mysqli->prepare("SELECT Student_ID FROM students WHERE Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Insert login if not already created
        $insert = $mysqli->prepare("INSERT INTO student_login (student_id, username, password) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $student_id, $username, $hashed_password);

        if ($insert->execute()) {
            $success = "Login created successfully!";
        } else {
            $error = "Error: Username might already be taken.";
        }

        $insert->close();
    } else {
        $error = "Student ID not found in student records.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f4ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .message {
            text-align: center;
            margin-bottom: 10px;
            color: green;
        }
        .error {
            color: red;
        }
        button {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Add Student Login</h2>
        <?php if (!empty($success)): ?>
            <div class="message"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Student ID:</label>
                <input type="text" name="student_id" required>
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Create Login</button>
        </form>
    </div>
</body>
</html>
