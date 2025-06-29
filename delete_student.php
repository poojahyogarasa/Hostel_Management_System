<?php
require 'db.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Step 1: Get the student's current room
    $stmt_room = $mysqli->prepare("SELECT Room_ID FROM students WHERE Student_ID = ?");
    $stmt_room->bind_param("s", $student_id);
    $stmt_room->execute();
    $result = $stmt_room->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $room_id = $row['Room_ID'];

        // Step 2: Delete the student
        $stmt_delete = $mysqli->prepare("DELETE FROM students WHERE Student_ID = ?");
        $stmt_delete->bind_param("s", $student_id);

        if ($stmt_delete->execute()) {
            // Step 3: Function to recalculate room status
            function updateRoomStatus($mysqli, $room_id) {
                $count = $mysqli->query("SELECT COUNT(*) AS cnt FROM students WHERE Room_ID = '$room_id'")->fetch_assoc()['cnt'];
                $capacity = $mysqli->query("SELECT Capacity FROM room WHERE Room_ID = '$room_id'")->fetch_assoc()['Capacity'];
                $new_status = ($count < $capacity) ? 'Available' : 'Occupied';
                $mysqli->query("UPDATE room SET Status = '$new_status' WHERE Room_ID = '$room_id'");
            }

            updateRoomStatus($mysqli, $room_id);

            echo "<script>alert('Student deleted successfully'); window.location='view_students.php';</script>";
        } else {
            echo "Error deleting student: " . $stmt_delete->error;
        }

        $stmt_delete->close();
    } else {
        echo "Student not found.";
    }

    $stmt_room->close();
}
?>
