<?php
include 'db.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=payments.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Payment ID', 'Student ID', 'Amount', 'Date']);

$result = $mysqli->query("SELECT Payment_ID, Student_ID, Amount, Date FROM payments");

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
