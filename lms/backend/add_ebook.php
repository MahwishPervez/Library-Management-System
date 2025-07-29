<?php
include 'db.php'; 

if (isset($_POST['upload'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $description = $_POST['description']; 

    $uploadDir = 'uploads/ebooks/';  
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  
    }

    $filename = basename($_FILES['pdf_file']['name']);
    $filepath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $filepath)) {
        $sql = "INSERT INTO ebooks (isbn, title, author, category, description, pdf_path) 
                VALUES ($isbn, '$title', '$author', '$category', '$description', '$filepath')";
        
        if ($conn->query($sql)) {
            echo "<script>alert('E-Book added successfully!'); window.location.href = '../frontend/Librarian/ebooks.php';</script>";
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "File upload failed!";
    }
}
?>
