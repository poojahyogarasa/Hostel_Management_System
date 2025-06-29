<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'];
    $status = $_POST['status'];

    // Validate input
    if (!empty($payment_id) && in_array($status, ['Pending', 'Approved'])) {
        $stmt = $conn->prepare("UPDATE payments SET Status = ? WHERE Payment_ID = ?");
        $stmt->bind_param("si", $status, $payment_id);

        if ($stmt->execute()) {
            header("Location: view_payments.php?success=1");
            exit();
        } else {
            echo "Failed to update payment status.";
        }

        $stmt->close();
    } else {
        echo "Invalid input.";
    }
}

$conn->close();
?>
