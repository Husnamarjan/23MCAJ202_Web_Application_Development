<?php
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'library';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $stmt = $conn->prepare("INSERT INTO books (accession_number, title, authors, edition, publisher) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['accession_number'], $_POST['title'], $_POST['authors'], $_POST['edition'], $_POST['publisher']);
    $stmt->execute();
    $stmt->close();
}


$search_results = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_book'])) {
    $search_title = "%" . $_POST['search_title'] . "%";
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
    $stmt->bind_param("s", $search_title);
    $stmt->execute();
    $result = $stmt->get_result();

    $search_results .= "<h2>Search Results</h2>";
    if ($result->num_rows > 0) {
        $search_results .= "<table><tr><th>Acc No</th><th>Title</th><th>Authors</th><th>Edition</th><th>Publisher</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $search_results .= "<tr>
                                    <td>{$row['accession_number']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['authors']}</td>
                                    <td>{$row['edition']}</td>
                                    <td>{$row['publisher']}</td>
                                </tr>";
        }
        $search_results .= "</table>";
    } else {
        $search_results .= "<p>No results found.</p>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Book Manager</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 15px;
            background: #fff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }
        input[type=text], input[type=submit] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type=submit] {
            background-color: #0066cc;
            color: white;
            margin-top: 15px;
            font-weight: bold;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #004a99;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #0066cc;
            color: white;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Library Book Manager</h1>

        <div class="section">
            <form method="post">
                <label>Accession Number</label>
                <input type="text" name="accession_number" required>

                <label>Title</label>
                <input type="text" name="title" required>

                <label>Authors</label>
                <input type="text" name="authors" required>

                <label>Edition</label>
                <input type="text" name="edition">

                <label>Publisher</label>
                <input type="text" name="publisher">

                <input type="submit" name="add_book" value="Add Book">
            </form>
        </div>

        <div class="section">
            <form method="post">
                <label>Search by Title</label>
                <input type="text" name="search_title" required>
                <input type="submit" name="search_book" value="Search Book">
            </form>
        </div>

        <div class="section">
            <?php echo $search_results; ?>
        </div>
    </div>
</body>
</html>
