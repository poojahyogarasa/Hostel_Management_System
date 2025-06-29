<?php
require 'db.php';

$months = [];
$amounts = [];

$query = "SELECT DATE_FORMAT(date, '%M') AS month, SUM(amount) AS total
          FROM payments
          GROUP BY MONTH(date)
          ORDER BY MONTH(date)";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $amounts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Payment Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #1e3a8a;
        }

        .chart-container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<h2>📊 Monthly Payment Analytics</h2>
<div class="chart-container">
    <canvas id="paymentChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('paymentChart').getContext('2d');
    const paymentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Total Amount (LKR)',
                data: <?php echo json_encode($amounts); ?>,
                backgroundColor: 'rgba(33, 102, 255, 0.6)',
                borderColor: 'rgba(33, 102, 255, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e3a8a',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount (LKR)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
