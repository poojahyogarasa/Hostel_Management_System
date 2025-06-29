<?php
require 'db.php';

// Handle status update if submitted
$successMessage = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $id = $_POST['complaint_id'];
    $newStatus = $_POST['status'];
    $update = $mysqli->query("UPDATE complaints SET Status='$newStatus' WHERE Complaint_ID='$id'");
    if ($update) {
        $successMessage = "✅ Complaint status updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Complaints</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f3f4f6, #e0e7ff);
            margin: 0;
            padding: 50px;
        }
        .container {
            background: #fff;
            border-radius: 14px;
            padding: 40px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #1f3c88;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th {
            background: #1f3c88;
            color: white;
            padding: 12px;
            font-size: 16px;
        }
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            font-size: 15px;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .success-msg {
            background-color: #e0f8e9;
            border: 1px solid #50c878;
            color: #2f7a3e;
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
        }
        select {
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #1f3c88;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #162c66;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📨 Student Complaints</h2>

        <?php if (!empty($successMessage)): ?>
            <div class="success-msg"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Complaint ID</th>
                <th>Student ID</th>
                <th>Date</th>
                <th>Complaint</th>
                <th>Status</th>
            </tr>
            <?php
            $result = $mysqli->query("SELECT * FROM complaints ORDER BY Date DESC");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Complaint_ID']}</td>
                            <td>{$row['Student_ID']}</td>
                            <td>{$row['Date']}</td>
                            <td>" . htmlspecialchars($row['complaint_text']) . "</td>
                            <td>
                                <form method='POST'>
                                    <input type='hidden' name='complaint_id' value='{$row['Complaint_ID']}'>
                                    <select name='status'>
                                        <option value='Processing' " . ($row['Status'] === 'Processing' ? 'selected' : '') . ">Processing</option>
                                        <option value='Completed' " . ($row['Status'] === 'Completed' ? 'selected' : '') . ">Completed</option>
                                    </select>
                                    <input type='submit' name='update_status' value='Update'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No complaints found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
