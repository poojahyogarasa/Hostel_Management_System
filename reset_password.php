<?php
include_once __DIR__ . "/db.php";
session_start();
if (!isset($_SESSION['student_id'])) header("Location: login_student.php");
$sid = $_SESSION['student_id'];
$msg = "";
if (isset($_POST['set'])) {
    $np = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE student_login SET Password='$np' WHERE Student_ID='$sid'");
    $_SESSION['reset_done'] = true;
    header("Location: dashboard_student.php");
    exit();
}
?>
<!DOCTYPE html>
<html><head><title>Set New Password</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="background"><div class="overlay">
<h2>Set Your New Password</h2>
<form method="POST">
<input type="password" name="new_password" placeholder="New Password" required><br>
<input type="submit" name="set" value="Update Password">
</form>
</div></div></body></html>
