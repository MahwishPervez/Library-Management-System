<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch eBooks from the database
$sql = "SELECT isbn, title, author, category FROM ebooks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/manage.css">
    <title>Manage EBooks</title>
</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Manage EBooks</h2>
            <div class="head-btns">
                <a href="add-ebook.html">ADD NEW</a>
            </div>
        </div>
        <div class="filters">
            <form action="">
                <input type="text" id="isbn" placeholder="Search by ISBN...">
                <input type="text" id="title" placeholder="Search by title...">
                <button class="clear-filters">Clear</button>
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo '<td class="actions">';
                            echo '<span class="material-symbols-outlined">edit_square</span>';
                            echo '<span class="material-symbols-outlined">delete</span>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No eBooks found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>
