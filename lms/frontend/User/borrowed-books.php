<?php
session_start();
include '../../backend/db.php'; 


if (!isset($_SESSION['user'])) {
    echo "User not logged in!";
    exit();
}

$user = $_SESSION['user']; 
$student_id = $user['university_id']; 


$sql = "SELECT * FROM issued_books WHERE student_id = '$student_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/manage.css">
    <title>Borrowed Books</title>

</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Borrowed Books</h2>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Days Left</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $isbn = $row['isbn'];
                            $title = $row['book_name'];
                            $author = $row['book_author'];
                            $issue_date = $row['issue_date'];
                            $due_date = $row['due_date'];

                            
                            $days_left = (strtotime($due_date) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
                            $days_left = max($days_left, 0); 

                            echo "<tr>
                                    <td>{$isbn}</td>
                                    <td>{$title}</td>
                                    <td>{$author}</td>
                                    <td>{$issue_date}</td>
                                    <td>{$due_date}</td>
                                    <td>{$days_left}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No borrowed books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
