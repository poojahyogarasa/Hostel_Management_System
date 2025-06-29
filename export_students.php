<?php
include 'db.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=students.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Student ID', 'Name', 'Faculty', 'Contact', 'Room ID']);

$result = $mysqli->query("SELECT Student_ID, Name, Faculty, Contact, Room_ID FROM students");

while ($row = $result->fetch_assoc()) {
    // Prefix Student ID with apostrophe to preserve formatting
    $row['Student_ID'] = "'" . $row['Student_ID'];
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
