<?php

include '../../backend/db.php'; 

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']); 
}


$sql = "SELECT * FROM issued_books WHERE reserve='No'"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/manage.css">
    <link rel="stylesheet" href="../styles/reserved-books.css">
    <title>Document</title>

</head>

<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">All Books</h2>
            <div class="head-btns">
                <a href="reserved-books.php">GO BACK</a>

            </div>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                                <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['book_author']); ?></td>

                                <td class="actions">
                                    <form action="../../backend/reserve_book.php" method="POST">
                                        <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($row['isbn']); ?>">
                                        <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['book_name']); ?>">
                                        <input type="hidden" name="author" value="<?php echo htmlspecialchars($row['book_author']); ?>">
                                        <input type="hidden" name="due_date" value="<?php echo htmlspecialchars($row['due_date']); ?>">
                                        <button class="unreserve-btn" type="submit">RESERVE</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>