<?php
session_start();
include 'db.php'; 


if (!isset($_SESSION['user'])) {
    die("User not logged in!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['isbn'])) {
        die("Invalid request!");
    }

    $isbn = $_POST['isbn'];
    $university_id = $_SESSION['user']['university_id']; 

    
    $checkSQL = "SELECT * FROM reserved_books WHERE isbn = ? AND university_id = ?";
    $stmt = $conn->prepare($checkSQL);
    $stmt->bind_param("ss", $isbn, $university_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Unauthorized action!");
    }

    
    $deleteSQL = "DELETE FROM reserved_books WHERE isbn = ? AND university_id = ?";
    $stmt = $conn->prepare($deleteSQL);
    $stmt->bind_param("ss", $isbn, $university_id);
    $stmt->execute();

    
    $updateIssuedSQL = "UPDATE issued_books SET reserve='No' WHERE isbn = ?";
    $stmt = $conn->prepare($updateIssuedSQL);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();

    
    $_SESSION['success_message'] = "Book unreserved successfully!";

    
    header("Location: ../frontend/User/reserved-books.php");
    exit();
} else {
    die("Invalid request method!");
}
?>
