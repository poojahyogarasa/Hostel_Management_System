<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}
$student_id = $_SESSION['student_id'];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php';

    $amount = $_POST['amount'];
    $payment_method = $_POST['method'];
    $date = date('Y-m-d');

    if (empty($payment_method)) {
        $success = "❌ Please select a payment method.";
    } else {
        $stmt = $conn->prepare("INSERT INTO payments (Student_ID, Amount, Status, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $student_id, $amount, $payment_method, $date);

        if ($stmt->execute()) {
            $success = "✅ Payment submitted successfully using <strong>$payment_method</strong>.";
        } else {
            $success = "❌ Error submitting payment.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 420px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .logos {
            margin-bottom: 20px;
        }
        .logos img {
            width: 50px;
            margin: 0 10px;
            cursor: pointer;
            opacity: 0.6;
            transition: transform 0.2s;
        }
        .logos img:hover,
        .logos img.selected {
            opacity: 1;
            transform: scale(1.1);
        }
        .hidden {
            display: none;
        }
        .input-group {
            text-align: left;
            margin-top: 15px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            background: #6c63ff;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>💳 Submit Payment</h2>

    <div class="logos">
        <img src="https://img.icons8.com/color/48/visa.png" alt="Visa" onclick="selectMethod('Visa', this)">
        <img src="https://img.icons8.com/color/48/mastercard-logo.png" alt="MasterCard" onclick="selectMethod('MasterCard', this)">
        <img src="https://img.icons8.com/color/48/paypal.png" alt="PayPal" onclick="selectMethod('PayPal', this)">
    </div>

    <form method="post">
        <input type="hidden" name="method" id="methodInput" required>

        <div class="input-group">
            <label>Enter Amount:</label>
            <input type="number" name="amount" step="0.01" required>
        </div>

        <div id="cardFields" class="hidden">
            <div class="input-group">
                <label>Card Number:</label>
                <input type="text" name="card_number" maxlength="16">
            </div>
            <div class="input-group">
                <label>Expiry Date:</label>
                <input type="text" name="expiry" placeholder="MM/YY">
            </div>
            <div class="input-group">
                <label>CVV:</label>
                <input type="text" name="cvv" maxlength="4">
            </div>
        </div>

        <div id="paypalFields" class="hidden">
            <div class="input-group">
                <label>PayPal Email:</label>
                <input type="text" name="paypal_email">
            </div>
        </div>

        <input type="submit" value="Submit Payment">
    </form>

    <?php if (!empty($success)): ?>
        <p class="message"><?php echo $success; ?></p>
    <?php endif; ?>
</div>

<script>
    function selectMethod(method, el) {
        document.getElementById('methodInput').value = method;

        // Clear previous selection
        document.querySelectorAll('.logos img').forEach(img => img.classList.remove('selected'));
        el.classList.add('selected');

        // Hide all fields
        document.getElementById('cardFields').classList.add('hidden');
        document.getElementById('paypalFields').classList.add('hidden');

        // Show fields based on method
        if (method === 'Visa' || method === 'MasterCard') {
            document.getElementById('cardFields').classList.remove('hidden');
        } else if (method === 'PayPal') {
            document.getElementById('paypalFields').classList.remove('hidden');
        }
    }
</script>
</body>
</html>
