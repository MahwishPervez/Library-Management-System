<?php
session_start();
include '../../backend/db.php'; 


if (!isset($_SESSION['user'])) {
    echo "User not logged in!";
    exit();
}

$user = $_SESSION['user']; 


$sqlTotalBooks = "SELECT COUNT(*) AS total_books FROM books";
$resultTotalBooks = $conn->query($sqlTotalBooks);
$totalBooks = ($resultTotalBooks) ? $resultTotalBooks->fetch_assoc()['total_books'] : 0;


$sqlIssuedBooks = "SELECT COUNT(*) AS issued_books FROM issued_books";
$resultIssuedBooks = $conn->query($sqlIssuedBooks);
$issuedBooks = ($resultIssuedBooks) ? $resultIssuedBooks->fetch_assoc()['issued_books'] : 0;


$sqlReservedBooks = "SELECT COUNT(*) AS reserved_books FROM reserved_books";
$resultReservedBooks = $conn->query($sqlReservedBooks);
$reservedBooks = ($resultReservedBooks) ? $resultReservedBooks->fetch_assoc()['reserved_books'] : 0;


$sqlTotalEbooks = "SELECT COUNT(*) AS total_ebooks FROM ebooks";
$resultTotalEbooks = $conn->query($sqlTotalEbooks);
$totalEbooks = ($resultTotalEbooks) ? $resultTotalEbooks->fetch_assoc()['total_ebooks'] : 0;

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
            <h3>Total Books</h3>
            <h2><?php echo $totalBooks; ?></h2>
            <a href="manage-books.php">View All</a>
        </div>
        <div>
            <h3>Issued Books</h3>
            <h2><?php echo $issuedBooks; ?></h2>
            <a href="issued-books.php">View All</a>
        </div>
        <div>
            <h3>Reserved Books</h3>
            <h2><?php echo $reservedBooks; ?></h2>
            <a href="reserved-books.php">View All</a>
        </div>
        <div>
            <h3>Total EBooks</h3>
            <h2><?php echo $totalEbooks; ?></h2>
            <a href="ebooks.php">View All</a>
        </div>
        
    </section>
</body>
</html>