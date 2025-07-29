<?php
    session_start();

    
if (!isset($_SESSION['user'])) {
    echo "User not logged in!";
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/manage.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="head">
            <h2 class="dashboard-titles">Your Information</h2>
        </div>
        <div class="user-details">
            <div>
                <h5>Name:</h5>
                <p><?php echo htmlspecialchars($user['name']);?></p>
            </div>
            <div>
                <h5>University Id:</h5>
                <p><?php echo htmlspecialchars($user['university_id']);?></p>
            </div>
           
            <div>
                <h5>Role:</h5>
                <p><?php echo htmlspecialchars($user['role']);?></p>
            </div>
            <div>
                <h5>Email:</h5>
                <p><?php echo htmlspecialchars($user['email']);?></p>
            </div>
            <div>
                <h5>Phone:</h5>
                <p><?php echo htmlspecialchars($user['phone']);?></p>
            </div>
            <div>
                <h5>Account Status:</h5>
                <p><?php echo htmlspecialchars($user['status']);?></p>
            </div>
            <div>
                <h5>Borrowed Books:</h5>
                <p><?php echo htmlspecialchars($user['borrowed_books']);?></p>
            </div>
            <div>
                <h5>Maximum Book Allowed:</h5>
                <p><?php echo htmlspecialchars($user['limit']);?></p>
            </div>
        </div>
    </div>
    </section>
</body>
</html>