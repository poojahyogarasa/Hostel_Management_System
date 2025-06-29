<?php
require 'db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $original_id = $_GET['id'];
    $stmt = $mysqli->prepare("SELECT * FROM students WHERE Student_ID = ?");
    $stmt->bind_param("s", $original_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_id = $_POST['original_id'];
    $student_id = $_POST['Student_ID'];
    $name = $_POST['Name'];
    $faculty = $_POST['Faculty'];
    $contact = $_POST['Contact'];
    $room_id = $_POST['Room_ID'];

    echo "Original ID: $original_id<br>";
    echo "New ID: $student_id<br>";

    // Get old room ID
    $stmt_old = $mysqli->prepare("SELECT Room_ID FROM students WHERE Student_ID = ?");
    $stmt_old->bind_param("s", $original_id);
    $stmt_old->execute();
    $result_old = $stmt_old->get_result();
    $old_data = $result_old->fetch_assoc();
    $old_room_id = $old_data['Room_ID'];

    // Update student info
    $stmt = $mysqli->prepare("UPDATE students SET Student_ID=?, Name=?, Faculty=?, Contact=?, Room_ID=? WHERE Student_ID=?");
    $stmt->bind_param("ssssss", $student_id, $name, $faculty, $contact, $room_id, $original_id);

    if ($stmt->execute()) {
        // ✅ Update complaints table if student ID changed
        if ($original_id !== $student_id) {
            $stmt_complaints = $mysqli->prepare("UPDATE complaints SET Student_ID = ? WHERE Student_ID = ?");
            if ($stmt_complaints) {
                $stmt_complaints->bind_param("ss", $student_id, $original_id);
                $stmt_complaints->execute();
                $stmt_complaints->close();
            } else {
                echo "Complaint update prepare error: " . $mysqli->error;
            }
        }

        // ✅ Update room statuses if room changed
        if ($old_room_id !== $room_id) {
            $countOld = $mysqli->query("SELECT COUNT(*) AS cnt FROM students WHERE Room_ID = '$old_room_id'")->fetch_assoc()['cnt'];
            $capacityOld = $mysqli->query("SELECT Capacity FROM room WHERE Room_ID = '$old_room_id'")->fetch_assoc()['Capacity'];
            $statusOld = ($countOld < $capacityOld) ? 'Available' : 'Occupied';
            $mysqli->query("UPDATE room SET Status = '$statusOld' WHERE Room_ID = '$old_room_id'");

            $countNew = $mysqli->query("SELECT COUNT(*) AS cnt FROM students WHERE Room_ID = '$room_id'")->fetch_assoc()['cnt'];
            $capacityNew = $mysqli->query("SELECT Capacity FROM room WHERE Room_ID = '$room_id'")->fetch_assoc()['Capacity'];
            $statusNew = ($countNew < $capacityNew) ? 'Available' : 'Occupied';
            $mysqli->query("UPDATE room SET Status = '$statusNew' WHERE Room_ID = '$room_id'");
        }

        echo "<script>alert('Student updated successfully'); window.location='view_students.php';</script>";
    } else {
        echo "Error updating student: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Edit Student</h2>
    <form method="POST">
        <input type="hidden" name="original_id" value="<?= $student['Student_ID'] ?>">
        <input type="text" name="Student_ID" placeholder="Student ID" value="<?= $student['Student_ID'] ?>" required>
        <input type="text" name="Name" placeholder="Name" value="<?= $student['Name'] ?>" required>
        <input type="text" name="Faculty" placeholder="Faculty" value="<?= $student['Faculty'] ?>" required>
        <input type="text" name="Contact" placeholder="Contact" value="<?= $student['Contact'] ?>" required>
        <input type="text" name="Room_ID" placeholder="Room ID" value="<?= $student['Room_ID'] ?>" required>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
