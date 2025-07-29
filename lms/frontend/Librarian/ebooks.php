<?php

include '../../backend/db.php'; 


$sql = "SELECT * FROM ebooks"; 
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
            <h2 class="dashboard-titles">Manage EBooks</h2>
            <div class="head-btns">
                <a href="add-ebook.php">ADD NEW</a>

            </div>
        </div>
        <div class="filters">
            <form action="">
                <input type="text" id="isbn" placeholder="Search by ISBN...">
                <input type="text" id="title" placeholder="Search by title...">
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
                        <th>Category</th>
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
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>

                                <td class="actions">
                                    <?php if (!empty($row['pdf_path'])) { ?>
                                        <a href="<?php echo htmlspecialchars($row['pdf_path']); ?>" target="_blank">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </a>
                                    <?php } else { ?>
                                        <span class="material-symbols-outlined" style="color: grey; cursor: not-allowed;" title="No PDF Available">visibility</span>
                                    <?php } ?>

                                    <a href="../../backend/delete_ebook.php?isbn=<?php echo urlencode($row['isbn']); ?>" onclick="return confirm('Are you sure you want to delete this book?');">
                                        <span class="material-symbols-outlined">delete</span>
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