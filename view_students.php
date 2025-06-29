<?php
require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body {
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
        }
        .wrapper {
            background-color: #fff;
            padding: 30px;
            border-radius: 16px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #5e35b1;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type=text] {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type=submit] {
            padding: 10px 20px;
            background-color: #5e35b1;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #5e35b1;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .action-buttons a {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin: 0 5px;
            color: white;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #4caf50;
        }
        .btn-delete {
            background-color: #e53935;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Student List</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Student ID or Name">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Faculty</th>
            <th>Contact</th>
            <th>Room ID</th>
            <th>Actions</th>
        </tr>
        <?php
        $search = $_GET['search'] ?? '';
        $sql = "SELECT * FROM students";
        if (!empty($search)) {
            $safe_search = $mysqli->real_escape_string($search);
            $sql .= " WHERE Student_ID LIKE '%$safe_search%' OR Name LIKE '%$safe_search%'";
        }
        $result = $mysqli->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['Student_ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Faculty']}</td>
                    <td>{$row['Contact']}</td>
                    <td>{$row['Room_ID']}</td>
                    <td class='action-buttons'>
                        <a href='edit_student.php?id={$row['Student_ID']}' class='btn-edit'>Edit</a>
                        <a href='delete_student.php?id={$row['Student_ID']}' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No students found</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
