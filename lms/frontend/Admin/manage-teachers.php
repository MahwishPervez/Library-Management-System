<?php

include '../../backend/db.php'; 


$sql = "SELECT * FROM users WHERE role='teacher'"; 
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
    <title>Manage Teachers</title>
</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Manage Teachers</h2>
        </div>
        <div class="filters">
            <form action="">
                <input type="text" id="name" placeholder="Search by name...">
                <input type="email" id="email" placeholder="Search by email...">
                <button class="clear-filters">Clear</button>
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['university_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="actions">
                                <a href="profile.php?university_id=<?php echo urlencode($row['university_id']); ?>">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="#"><span class="material-symbols-outlined">edit_square</span></a>
                                    <a href="#"><span class="material-symbols-outlined">delete</span></a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No Users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
