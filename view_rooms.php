<?php
require 'db.php';

// Auto-update all room statuses before displaying
$roomList = $mysqli->query("SELECT Room_ID, Capacity FROM room");
while ($room = $roomList->fetch_assoc()) {
    $room_id = $room['Room_ID'];
    $capacity = $room['Capacity'];

    $count = $mysqli->query("SELECT COUNT(*) AS cnt FROM students WHERE Room_ID = '$room_id'")->fetch_assoc()['cnt'];
    $status = ($count < $capacity) ? 'Available' : 'Occupied';

    $mysqli->query("UPDATE room SET Status = '$status' WHERE Room_ID = '$room_id'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Room List</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            padding: 50px;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #c94b4b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 30px;
        }
        th {
            background: #c94b4b;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f3f3f3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🛏️ Room List</h2>
        <table>
            <tr>
                <th>Room ID</th>
                <th>Room Type</th>
                <th>Capacity</th>
                <th>Status</th>
            </tr>
            <?php
            $result = $mysqli->query("SELECT * FROM room");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['Room_ID']}</td>
                        <td>{$row['Room_Type']}</td>
                        <td>{$row['Capacity']}</td>
                        <td>{$row['Status']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No room data found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
