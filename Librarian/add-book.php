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

// Add Book Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $author = $conn->real_escape_string($_POST['author']);
    $category = $conn->real_escape_string($_POST['category']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO books (isbn, author, category, title, description) VALUES ('$isbn', '$author', '$category', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Book added successfully!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/add.css">
    <title>Add New Book</title>
</head>
<body>
    <section>
        <h2 class="dashboard-titles">Add New Book</h2>
        <form method="POST" action="add-book.php">
            <div class="input-group">
                <div class="input-container">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" required placeholder="Enter ISBN">
                </div>
                <div class="input-container">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" required placeholder="Enter author">
                </div>
                <div class="input-container">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="" disabled selected>Select category</option>
                        <option value="student">Student</option>
                        <option value="librarian">Librarian</option>
                    </select>
                </div>
            </div>
            <div class="input-container">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required placeholder="Enter title">
            </div>
            <div class="input-container">
                <label for="description">Description (Optional)</label>
                <textarea name="description" id="description" placeholder="Enter description" rows="4"></textarea>
            </div>
            <div class="btn-container">
                <input class="go-back" type="button" value="Go Back" onclick="history.back()">
                <input class="submit" type="submit" value="Submit">
            </div>
        </form>
    </section>
</body>
</html>
