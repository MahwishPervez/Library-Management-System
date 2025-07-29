<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    
    $status = "available";

    $sql = "INSERT INTO books (isbn, title, author, category, description, status) 
            VALUES ('$isbn', '$title', '$author', '$category', '$description', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book added successfully!'); window.location.href = '../frontend/Librarian/manage-books.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>