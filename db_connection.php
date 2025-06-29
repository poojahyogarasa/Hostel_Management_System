<?php
$conn = new mysqli("localhost", "root", "", "hostel_db"); // update db name if different

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
