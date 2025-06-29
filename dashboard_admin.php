<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            background: linear-gradient(to right, #f3e7e9, #e3eeff);
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 40px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        .admin-icon {
            width: 70px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            margin: 15px;
            padding: 12px 24px;
            font-size: 16px;
            color: white;
            background-color: #6c5ce7;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #5a4bcf;
        }
    </style>
</head>
<body>
<div class="container">
    <img class="admin-icon" src="assets/admin.png" alt="Admin Icon">
    <h1>Welcome, <?php echo $_SESSION['admin_id']; ?> 👋</h1>

    <div>
        <a class="btn" href="register_student.php">Add New Student</a>
        <a class="btn" href="add_student_login.php">Add Student Login</a> <!-- Added link -->
        <a class="btn" href="view_students.php">View Students</a>
        <a class="btn" href="view_rooms.php">View Rooms</a>
        <a class="btn" href="view_complaints.php">View Complaints</a>
        <a class="btn" href="view_payments.php">View Payments</a>
        <a class="btn" href="send_notification.php">Send Notification</a>
        <a class="btn" href="payment_chart.php">Payment Analytics</a>
        <a class="btn" href="export_students.php">Export Students CSV</a>
        <a class="btn" href="export_payments.php">Export Payments CSV</a>
        <a class="btn" href="view_log.php">View Activity Log</a>
        <a class="btn" href="logout.php" style="background:#e74c3c;">Logout</a>
    </div>
</div>
</body>
</html>
