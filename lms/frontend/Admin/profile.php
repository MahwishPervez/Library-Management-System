<?php

include '../../backend/db.php';


if (isset($_GET['university_id'])) {
    $university_id = $conn->real_escape_string($_GET['university_id']);

    
    $sql = "SELECT * FROM users WHERE university_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $university_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
    } else {
        echo "User not found!";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No user ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="user-details">
            <div>
                <h5>Name:</h5>
                <p><?php echo htmlspecialchars($user['name']); ?></p>
            </div>
            <div>
                <h5>University Id:</h5>
                <p><?php echo htmlspecialchars($user['university_id']); ?></p>
            </div>
            
            <div>
                <h5>Role:</h5>
                <p><?php echo htmlspecialchars($user['role']); ?></p>
            </div>
            <div>
                <h5>Account Status:</h5>
                <p><?php echo htmlspecialchars($user['status']); ?></p>
            </div>
            <div>
                <h5>Borrowed Books:</h5>
                <p><?php echo htmlspecialchars($user['borrowed_books']); ?></p>
            </div>
            <div>
                <h5>Maximum Book Allowed:</h5>
                <p><?php echo htmlspecialchars($user['limit']); ?></p>
            </div>
           
        </div>
    </div>
    </section>
</body>
</html>