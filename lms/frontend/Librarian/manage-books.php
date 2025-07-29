<?php

include '../../backend/db.php'; 


$sql = "SELECT isbn, title, author, status FROM books"; 
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
    <title>Document</title>

</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Manage Books</h2>
            <div class="head-btns">
                <a href="add-book.php">ADD NEW</a>
                
            </div>
        </div>
        <div class="filters">
            <form action="">
                <input type="text" id="isbn" placeholder="Search by ISBN...">
                <input type="text" id="title" placeholder="Search by title...">
                <select id="availability" name="availability">
                    <option value="" disabled selected>Filter by status</option>
                    <option value="available">Available</option>
                    <option value="issued">Issued</option>
                    <option value="reserved">Reserved</option>
                </select>
                <button class="clear-filters">Clear</button>
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                            $statusClass = "";
                            if ($row['status'] == "available") {
                                $statusClass = "status-available";
                            } elseif ($row['status'] == "issued") {
                                $statusClass = "status-issued";
                            } elseif ($row['status'] == "reserved") {
                                $statusClass = "status-reserved";
                            }
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td>
                                <td class="<?php echo $statusClass; ?> status">
                                    <span><?php echo ucfirst($row['status']); ?></span>
                                </td>
                                <td class="actions">
                                    <a href="">
                                        <span class="material-symbols-outlined">edit_square</span>
                                    </a>
                                    
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