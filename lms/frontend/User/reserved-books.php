<?php
session_start();
include '../../backend/db.php'; 


if (!isset($_SESSION['user'])) {
    die("User not logged in!");
}

$user = $_SESSION['user']; 
$university_id = $user['university_id']; 


$sql = "SELECT * FROM reserved_books WHERE university_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $university_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/manage.css">
    <link rel="stylesheet" href="../styles/reserved-books.css">
    <title>Reserved Books</title>
</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Reserved Books</h2>
            <div class="head-btns">
                <a href="all-books.php">RESERVE NEW</a>
            </div>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Reserved Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td>
                                <td><?php echo htmlspecialchars($row['reserved_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                                <td class="actions">
                                    <form action="../../backend/unreserve_book.php" method="POST">
                                        <input type="hidden" name="isbn" value="<?php echo $row['isbn']; ?>">
                                        <button type="submit" class="unreserve-btn">UN-RESERVE</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No reserved books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
