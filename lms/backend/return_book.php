<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST["isbn"];
    $student_id = $_POST["student_id"];

    
    $delete_sql = "DELETE FROM issued_books WHERE isbn = ? AND student_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("ss", $isbn, $student_id);

    if ($stmt->execute()) {
        
        $update_sql = "UPDATE books SET status = 'available' WHERE isbn = ?";
        $stmt2 = $conn->prepare($update_sql);
        $stmt2->bind_param("s", $isbn);
        $stmt2->execute();
        $stmt2->close();

        
        $update_user_sql = "UPDATE users SET borrowed_books = GREATEST(borrowed_books - 1, 0) WHERE university_id = ?";
        $stmt3 = $conn->prepare($update_user_sql);
        $stmt3->bind_param("s", $student_id);
        $stmt3->execute();
        $stmt3->close();

        $_SESSION['message'] = "Book returned successfully!";
    } else {
        $_SESSION['message'] = "Error processing request!";
    }

    $stmt->close();
    $conn->close();

    
    header("Location: ../frontend/Librarian/issued-books.php");
    exit();
}
?>
