<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d9f0e6;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";       
$password = "";          
$dbname = "studentDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<p style='text-align:center; color:red;'>Connection failed: " . $conn->connect_error . "</p>");
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo "<h2>Student Details</h2>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row["id"]}</td>
                <td>{$row["name"]}</td>
                <td>{$row["email"]}</td>
                <td>{$row["course"]}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data found</p>";
}

$conn->close();
?>

</body>
</html>
