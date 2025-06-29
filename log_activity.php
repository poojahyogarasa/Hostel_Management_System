<?php
function logActivity($action) {
    include("db.php");
    $stmt = $conn->prepare("INSERT INTO activity_log (Action) VALUES (?)");
    $stmt->bind_param("s", $action);
    $stmt->execute();
}
?>