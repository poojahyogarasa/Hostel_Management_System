<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

require 'db.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['student_id'];
    $complaint = trim($_POST['complaint']);

    if (!empty($complaint)) {
        // ✅ Use correct type 's' for VARCHAR Student_ID
        $check = $mysqli->prepare("SELECT 1 FROM students WHERE Student_ID = ?");
        $check->bind_param("s", $student_id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            // ✅ Use 'ss' because both Student_ID and complaint_text are strings
            $stmt = $mysqli->prepare("INSERT INTO complaints (Student_ID, complaint_text, Date, Status) VALUES (?, ?, NOW(), 'Processing')");
            $stmt->bind_param("ss", $student_id, $complaint);
            if ($stmt->execute()) {
                $success = true;
            } else {
                $error = "❌ Failed to submit complaint. Please try again later.";
            }
            $stmt->close();
        } else {
            $error = "❌ Invalid student session. Please login again.";
        }
        $check->close();
    } else {
        $error = "❌ Complaint text cannot be empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Complaint</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Nunito', sans-serif;
        }
        .container {
            max-width: 450px;
            margin: 80px auto;
            background: #fff;
            padding: 40px 30px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #2c3e50;
        }
        textarea {
            width: 100%;
            height: 140px;
            padding: 15px;
            font-size: 15px;
            border: 1.5px solid #dce3e8;
            border-radius: 10px;
            resize: none;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
            transition: all 0.2s ease;
        }
        textarea:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }
        button {
            margin-top: 20px;
            background: #4a90e2;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #3a78c4;
        }
        .success-message, .error-message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 10px;
            font-weight: 600;
        }
        .success-message {
            background: #e3f7e8;
            color: #2e7d32;
        }
        .error-message {
            background: #fdecea;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📨 Submit Complaint</h2>
        <form method="post" action="">
            <textarea name="complaint" placeholder="Describe your complaint..." required></textarea>
            <br>
            <button type="submit">🚀 Submit</button>
        </form>

        <?php if ($success): ?>
            <div class="success-message">✅ Your complaint has been submitted!</div>
        <?php elseif (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
