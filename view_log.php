<?php
require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Activity Log</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #34495e;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📝 Admin Activity Log</h2>

    <?php
    $query = "SELECT * FROM log ORDER BY time DESC"; // Change 'log' to your actual table name
    $result = $mysqli->query($query);

    echo "<table>
            <tr>
                <th>Time</th>
                <th>Action</th>
            </tr>";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['time']}</td><td>{$row['action']}</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No log data found.</td></tr>";
    }
    echo "</table>";
    ?>
</div>
</body>
</html>
