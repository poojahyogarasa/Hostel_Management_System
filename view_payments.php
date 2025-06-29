<?php
session_start();
// Optional admin session check
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.php");
//     exit();
// }

include 'db_connection.php';

$sql = "SELECT * FROM payments ORDER BY Payment_ID DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Payment Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6fc;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 900px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1a237e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #1a237e;
            color: white;
        }

        form select {
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            padding: 4px 10px;
            border: none;
            background: #6a5acd;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 5px;
        }

        form input[type="submit"]:hover {
            background: #5a4acb;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn-back {
            margin-top: 20px;
            display: inline-block;
            background: #1a237e;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background: #303f9f;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📋 Payment Records (Admin)</h2>

    <?php if (isset($_GET['success'])): ?>
        <p class="success">✔ Payment status updated successfully.</p>
    <?php endif; ?>

    <table>
        <tr>
            <th>Payment ID</th>
            <th>Student ID</th>
            <th>Amount (Rs)</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['Payment_ID']; ?></td>
                <td><?= htmlspecialchars($row['Student_ID']); ?></td>
                <td><?= number_format($row['Amount'], 2); ?></td>
                <td><?= $row['Date']; ?></td>
                <td>
                    <form method="post" action="update_payment_status.php">
                        <input type="hidden" name="payment_id" value="<?= $row['Payment_ID']; ?>">
                        <select name="status">
                            <option value="Pending" <?= $row['Status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?= $row['Status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                        </select>
                        <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div style="text-align:center;">
        <a href="dashboard_admin.php" class="btn-back">← Back to Dashboard</a>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
