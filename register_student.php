<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['Student_ID'];
    $name = $_POST['Name'];
    $contact = $_POST['Contact'];
    $room_id = $_POST['Room_ID'];
    $faculty = $_POST['Faculty'];

    $stmt = $mysqli->prepare("INSERT INTO students (Student_ID, Name, Contact, Room_ID, Faculty) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $student_id, $name, $contact, $room_id, $faculty);

    if ($stmt->execute()) {
        echo "<script>alert('Student registered successfully'); window.location='dashboard_admin.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register New Student</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #c471f5, #fa71cd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 0px 25px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #6a11cb;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            background-color: #6a11cb;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #5311a8;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register New Student</h2>
        <form method="post" action="">
            <input type="text" name="Student_ID" placeholder="Student ID" required>
            <input type="text" name="Name" placeholder="Student Name" required>
            <input type="text" name="Contact" placeholder="Contact Number" required>
            <input type="text" name="Room_ID" placeholder="Room ID" required>
            <input type="text" name="Faculty" placeholder="Faculty" required>
            <button type="submit">Register Student</button>
        </form>
    </div>
</body>
</html>
