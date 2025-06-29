<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}
$student_id = $_SESSION['student_id'];
require 'db.php';

// Fetch notifications
$notif_result = $mysqli->query("SELECT message, date FROM notifications ORDER BY date DESC LIMIT 5");

// Fetch student + room details
$stmt = $mysqli->prepare("SELECT s.Name, s.Room_ID, r.Room_Type, r.Capacity, r.Status FROM students s JOIN room r ON s.Room_ID = r.Room_ID WHERE s.Student_ID = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background: #f3f6fc;
      font-family: 'Nunito', sans-serif;
    }
    .header {
      background: linear-gradient(to right, #343a40, #2d2d58);
      color: white;
      padding: 18px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 20px;
      font-weight: bold;
    }
    .logout-btn {
      background: #ff4d4d;
      padding: 10px 20px;
      border: none;
      color: white;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .logout-btn:hover {
      background: #d93636;
    }
    .main {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .container {
      display: grid;
      gap: 25px;
    }
    .card {
      padding: 24px 30px;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      color: #2d2d58;
      transition: transform 0.2s ease-in-out;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card h3 {
      font-size: 20px;
      margin-bottom: 12px;
    }
    .card p, .card li {
      font-size: 15px;
      line-height: 1.6;
    }
    .card ul {
      list-style: none;
      padding-left: 0;
    }
    .card li::before {
      content: "🔔";
      margin-right: 10px;
    }
    .card.blue    { background: #e0ecff; }
    .card.pink    { background: #ffe0e6; }
    .card.yellow  { background: #fff5cc; }
    .card.purple  { background: #eee3ff; }
    .card.green   { background: #e0fff3; }
    .card.gray    { background: #f5f7fa; }

    .btn {
      display: inline-block;
      background: #6c63ff;
      color: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      text-decoration: none;
      margin-top: 10px;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background: #594ed2;
    }

    .image-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
    .image-wrapper img {
      max-width: 100%;
      max-height: 100%;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .footer {
      text-align: center;
      color: #999;
      font-size: 13px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="header">
    <div>🎓 Welcome, <span style="font-weight:bold; text-transform:uppercase;"><?= htmlspecialchars($student['Name']) ?></span></div>
    <form action="logout.php" method="post">
      <button class="logout-btn">Logout</button>
    </form>
  </div>

  <div class="main">
    <div class="container">
      <div class="card gray">
        <h3>📋 Student Dashboard</h3>
        <p>Explore your student portal, stay informed, and manage your hostel activities with ease.</p>
      </div>

      <div class="card yellow">
        <h3>📰 Recent Notifications</h3>
        <ul>
          <?php while ($row = $notif_result->fetch_assoc()): ?>
            <li><strong><?= htmlspecialchars($row['date']) ?>:</strong> <?= htmlspecialchars($row['message']) ?></li>
          <?php endwhile; ?>
        </ul>
      </div>

      <div class="card pink">
        <h3>📨 Raise Complaint</h3>
        <p>If you face any issue in the hostel:</p>
        <a class="btn" href="complaints.php">Submit a Complaint</a>
      </div>

      <div class="card blue">
        <h3>💳 Make Payment</h3>
        <p>Pay your hostel fees easily:</p>
        <a class="btn" href="submit_payment.php">Make a Payment</a>
      </div>

      <div class="card purple">
        <h3>🔒 Change Password</h3>
        <p>Update your login password securely:</p>
        <a class="btn" href="change_password.php">Change Password</a>
      </div>

      <div class="card green">
        <h3>🛌 Your Room Details</h3>
        <ul>
          <li><strong>Room ID:</strong> <?= htmlspecialchars($student['Room_ID']) ?></li>
          <li><strong>Room Type:</strong> <?= htmlspecialchars($student['Room_Type']) ?></li>
          <li><strong>Capacity:</strong> <?= htmlspecialchars($student['Capacity']) ?></li>
          <li><strong>Status:</strong> <?= htmlspecialchars($student['Status']) ?></li>
        </ul>
      </div>
    </div>

    <div class="image-wrapper">
      <img src="assets/hostel_rules.png" alt="Hostel Rules">
    </div>
  </div>

  <div class="footer">
    &copy; <?= date("Y") ?> Hostel Management System. All rights reserved.
  </div>
</body>
</html>
