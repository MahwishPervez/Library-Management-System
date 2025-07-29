<?php
session_start();
include '../../backend/db.php';

$searched_user = $_SESSION['searched_user'] ?? null;
$searched_book = $_SESSION['searched_book'] ?? null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_user'])) {
    $email = $_POST['email'] ?? '';
    $university_id = $_POST['university_id'] ?? '';

    if (!empty($email) || !empty($university_id)) {
        $sql = "SELECT * FROM users WHERE email='$email' OR university_id='$university_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $searched_user = $result->fetch_assoc();
            $_SESSION['searched_user'] = $searched_user;  
        } else {
            echo "User not found.";
            $_SESSION['searched_user'] = null;
            $searched_user = null;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_book'])) {
    $isbn = $_POST['isbn'] ?? '';

    if (!empty($isbn)) {
        $sql = "SELECT * FROM books WHERE isbn='$isbn'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $searched_book = $result->fetch_assoc();
            $_SESSION['searched_book'] = $searched_book;  
        } else {
            echo "Book not found.";
            $_SESSION['searched_book'] = null;
            $searched_book = null;
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['issue_book'])) {
    if ($searched_user && $searched_book) {
        $isbn = $searched_book['isbn'];
        $book_name = $searched_book['title'];
        $book_author = $searched_book['author'];
        $student_id = $searched_user['university_id'];
        $issue_date = date("Y-m-d");  
        $due_date = date("Y-m-d", strtotime($issue_date . " +14 days")); 
        $fine = 0;
        $fine_status = "No Fine";

        
        if ($searched_book['status'] === "issued") {
            $message = "This book is already issued.";
        } else {
            
            $sql = "INSERT INTO issued_books (isbn, book_name, book_author, student_id, fine, fine_status, issue_date, due_date) 
                    VALUES ('$isbn', '$book_name', '$book_author', '$student_id', '$fine', '$fine_status', '$issue_date', '$due_date')";

            if ($conn->query($sql) === TRUE) {
                
                $update_sql = "UPDATE books SET status='issued' WHERE isbn='$isbn'";
                $sql_update_user = "UPDATE users SET borrowed_books = borrowed_books + 1 WHERE university_id='$student_id'";
                if ($conn->query($update_sql) === TRUE && $conn->query($sql_update_user) === TRUE) {
                    $message = "Book issued successfully!";
                } else {
                    $message = "Error updating book status: " . $conn->error;
                }
            } else {
                $message = "Error issuing book: " . $conn->error;
            }
        }
    } else {
        $message = "Please search for both student and book before issuing.";
    }

    
    $_SESSION['searched_user'] = null;
    $_SESSION['searched_book'] = null;
    echo "<script>alert('Book issued successfully!'); window.location.href='issue-book.php';</script>";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/issue-book.css">
    <title>Document</title>
</head>

<body>
    <section>
        <h2 class="dashboard-titles">Issue Book</h2>

        <div class="container">
            <div>
                <h3>Search Student</h3>
                <p>Find the user whom you want to issue books to.</p>
                <form action="" method="post">
                    <input type="email" id="email" placeholder="Search by email..." name="email">
                    <input type="text" id="id" placeholder="Search by college Id..." name="university_id">
                    <input class="submit" type="submit" value="Search" name="search_user">
                </form>

                <?php if ($searched_user): ?>
                    <div class="user-details">
                        <div>
                            <h5>Name:</h5>
                            <p><?= $searched_user['name'] ?></p>
                        </div>
                        <div>
                            <h5>University Id:</h5>
                            <p><?= $searched_user['university_id'] ?></p>
                        </div>
                        <div>
                            <h5>Role:</h5>
                            <p><?= $searched_user['role'] ?></p>
                        </div>
                        <div>
                            <h5>Account Status:</h5>
                            <p><?= $searched_user['status'] ?></p>
                        </div>
                        <div>
                            <h5>Borrowed Books:</h5>
                            <p><?= $searched_user['borrowed_books'] ?></p>
                        </div>
                        <div>
                            <h5>Maximum Book Allowed:</h5>
                            <p><?= $searched_user['limit'] ?></p>
                        </div>
                        <!-- <div>
                            <h5>Exceed Limit:</h5>
                            <p>No</p>
                        </div> -->
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <h3>Search Book</h3>
                <p>Find the book you want to issue.</p>
                <form action="" method="post">
                    <input type="text" id="isbn" placeholder="Search by ISBN..." name="isbn">
                    <input class="submit" type="submit" value="Search" name="search_book">
                </form>

                <?php if ($searched_book): ?>
                    <div class="book-details">
                        <div>
                            <h5>ISBN:</h5>
                            <p><?= $searched_book['isbn'] ?></p>
                        </div>
                        <div>
                            <h5>Title:</h5>
                            <p><?= $searched_book['title'] ?></p>
                        </div>
                        <div>
                            <h5>Author:</h5>
                            <p><?= $searched_book['author'] ?></p>
                        </div>
                        <div>
                            <h5>Status:</h5>
                            <p><?= ucfirst($searched_book['status']) ?></p>
                        </div>

                        <?php if ($searched_book['status'] !== 'issued' && $searched_user['borrowed_books'] < $searched_user['limit']): ?>
                            <form method="post" action="">
                                <input style="border: 2px solid #CA254C;" class="issue-btn" type="hidden" name="issue_book" value="1">
                                <input style="border: 2px solid #CA254C;" class="issue-btn" type="submit" value="Issue Book" name="issue_book">
                            </form>
                        <?php elseif ($searched_book['status'] === 'issued'): ?>
                            <p style="color: red;">This book is already issued.</p>
                        <?php elseif ($searched_user['borrowed_books'] >= $searched_user['limit']): ?>
                            <p style="color: red;">User has reached the maximum borrowing limit.</p>
                        <?php endif; ?>


                    </div>
                <?php endif; ?>
            </div>
        </div>



    </section>
</body>

</html>