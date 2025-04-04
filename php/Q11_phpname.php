<!DOCTYPE html>
<html>
<head>
    <title>Student Array Sorting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 40px;
            text-align: center;
        }
        h2, h3 {
            color: #333;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        .section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <h2>Student Name Sorting using PHP</h2>

    <?php
    $students = ["Husna", "Ashmal", "Riza", "Hezlin", "Jazlan", "Jazeel"];
    function displayTable($array, $title) {
        echo "<div class='section'>";
        echo "<h3>$title</h3>";
        echo "<table>";
        echo "<tr><th>Index</th><th>Student Name</th></tr>";
        foreach ($array as $index => $value) {
            echo "<tr><td>$index</td><td>$value</td></tr>";
        }
        echo "</table></div>";
    }
    displayTable($students, "Original Student List");
    asort($students);
    displayTable($students, "Sorted in Ascending Order");
    arsort($students);
    displayTable($students, "Sorted in Descending Order");
    ?>

</body>
</html>
