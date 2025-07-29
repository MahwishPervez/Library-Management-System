<?php
session_start();
include '../../backend/db.php'; 


$sql = "SELECT * FROM issued_books WHERE fine_status <> 'paid' ORDER BY issue_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../styles/utility.css">

    <link rel="stylesheet" href="../styles/manage.css">
    <link rel="stylesheet" href="../styles/issued-books.css">
    <title>Document</title>

</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Issued Books</h2>
            <div class="head-btns">
                <a href="issue-book.php">ISSUE BOOK</a>
                
            </div>
        </div>
        <div class="filters">
            <form action="">
                <input type="text" id="isbn" placeholder="Search by ISBN...">
                <input type="text" id="id" placeholder="Search by Student Id...">
                <input type="email" id="email" placeholder="Search by email...">
                <button class="clear-filters">Clear</button>
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Student Id</th>
                        <th>Issued Date</th>
                        <th>Due Date</th>
                        <th>Fine</th>
                        <th>Fine Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fine_status_class = ($row['fine_status'] == 'unpaid') ? 'status-unpaid' : 'status-paid';
                            $disabled = ($row['fine_status'] != 'unpaid') ? 'disabled' : '';
                            echo "<tr>
                                <td>{$row['isbn']}</td>
                                <td>{$row['student_id']}</td>
                                <td>{$row['issue_date']}</td>
                                <td>{$row['due_date']}</td>
                                <td>\${$row['fine']}</td>
                                <td class='{$fine_status_class} status'><span>" . ucfirst($row['fine_status']) . "</span></td>
                                <td class='actions'>
                                    <form action='../../backend/pay_fine.php' method='POST'onsubmit='return confirm(\"Are you sure you want to pay the fine and return the book?\")' style='display:inline;'>
                                        <input type='hidden' name='isbn' value='{$row['isbn']}'>
                                        <input type='hidden' name='student_id' value='{$row['student_id']}'>
                                        <button type='submit' class='btn-pay' $disabled>Pay Fine</button>
                                    </form>

                                    <form action='../../backend/return_book.php' method='POST' onsubmit='return confirm(\"Are you sure you want to return this book?\")' style='display:inline;'>
                                        <input type='hidden' name='isbn' value='{$row['isbn']}'>
                                        <input type='hidden' name='student_id' value='{$row['student_id']}'>
                                        <button type='submit' class='btn-return'>Return</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No issued books found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </section>
</body>
</html>