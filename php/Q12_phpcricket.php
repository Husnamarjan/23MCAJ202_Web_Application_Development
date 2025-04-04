<?php
$players = ["Virat Kohli", "Rohit Sharma", "MS Dhoni", "Sachin Tendulkar", "Hardik Pandya", "Jasprit Bumrah", "Shubman Gill", "Ravindra Jadeja", "KL Rahul", "Rishabh Pant"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Cricket Players</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Indian Cricket Players</h2>
    <table>
        <tr>
            <th>S.No</th>
            <th>Player Name</th>
        </tr>
        <?php
        $count = 1;
        foreach ($players as $player) {
            echo "<tr>
                    <td>{$count}</td>
                    <td>{$player}</td>
                  </tr>";
            $count++;
        }
        ?>
    </table>
</body>
</html>
