<?php
session_start();
include 'db.php'; 


if (!isset($_SESSION['user'])) {
    die("User not logged in!");
}

$user = $_SESSION['user']; 
$university_id = $user['university_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $due_date = $_POST['due_date'];
    $reserved_date = date("Y-m-d"); 

    
    $updateIssuedSQL = "UPDATE issued_books SET reserve='Yes' WHERE isbn='$isbn'";
    $conn->query($updateIssuedSQL);

    
    $insertSQL = "INSERT INTO reserved_books (isbn, title, author, reserved_date, due_date, university_id)
                  VALUES ($isbn, '$title', '$author', '$reserved_date', '$due_date', '$university_id')";
    $conn->query($insertSQL);

    $_SESSION['success_message'] = "Book '$title' reserved successfully!";

    
    header("Location: ../frontend/User/all-books.php");
    exit();
}
?>
