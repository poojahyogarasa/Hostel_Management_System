<?php
include_once __DIR__ . "/db.php";
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}
$result = $conn->query("SELECT * FROM room WHERE Status = 'Available'");
?>
<!DOCTYPE html>
<html>
<head><title>Available Rooms</title><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="background"><div class="overlay">
<h2>Available Rooms</h2>
<table border="1">
<tr><th>Room ID</th><th>Room Type</th><th>Capacity</th><th>Status</th></tr>
<?php while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['Room_ID']}</td>
            <td>{$row['Room_Type']}</td>
            <td>{$row['Capacity']}</td>
            <td>{$row['Status']}</td>
          </tr>";
} ?>
</table>
</div></div>
</body>
</html>
