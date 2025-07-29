<?php
session_start();
include '../../backend/db.php'; 


if (!isset($_SESSION['user'])) {
    echo "User not logged in!";
    exit();
}

$user = $_SESSION['user']; 
$university_id = $user['university_id']; 


$sqlBorrowedBooks = "SELECT COUNT(*) AS borrowed_books FROM issued_books WHERE student_id = ?";
$stmt = $conn->prepare($sqlBorrowedBooks);
$stmt->bind_param("s", $university_id);
$stmt->execute();
$resultBorrowedBooks = $stmt->get_result();
$totalBooks = ($resultBorrowedBooks) ? $resultBorrowedBooks->fetch_assoc()['borrowed_books'] : 0;


$sqlReservedBooks = "SELECT COUNT(*) AS reserved_books FROM reserved_books WHERE university_id = ?";
$stmt = $conn->prepare($sqlReservedBooks);
$stmt->bind_param("s", $university_id);
$stmt->execute();
$resultReservedBooks = $stmt->get_result();
$totalReservedBooks = ($resultReservedBooks) ? $resultReservedBooks->fetch_assoc()['reserved_books'] : 0;


$sqlOverdueBooks = "SELECT COUNT(*) AS overdue_books FROM issued_books WHERE student_id = ? AND DATEDIFF(due_date, CURDATE()) <= 0";
$stmt = $conn->prepare($sqlOverdueBooks);
$stmt->bind_param("s", $university_id);
$stmt->execute();
$resultOverdueBooks = $stmt->get_result();
$totalOverdueBooks = ($resultOverdueBooks) ? $resultOverdueBooks->fetch_assoc()['overdue_books'] : 0;


$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div>
            <h3>Borrowed Books</h3>
            <h2><?php echo $totalBooks; ?></h2>
            <a href="borrowed-books.php">View All</a>
        </div>
        <div>
            <h3>Reserved Books</h3>
            <h2><?php echo $totalReservedBooks; ?></h2>
            <a href="reserved-books.php">View All</a>
        </div>
        <!-- <div>
            <h3>Returned Books</h3>
            <h2>3</h2>
            <a href="">View All</a>
        </div> -->
        <div>
            <h3>Overdue Books</h3>
            <h2><?php echo $totalOverdueBooks; ?></h2>
            <a href="borrowed-books.php">View All</a>
        </div>
        
    </section>
</body>
</html>