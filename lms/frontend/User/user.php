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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/common-dashboard.css">
    <link rel="icon" type="image/svg+xml" href="../images/logo.svg">
    <title>User | Lexora - Your Library, Anytime, Anywhere.</title>

</head>

<body>
    <div class="sidebar">
        <div class="user-info">
            <h2 class="user-name" id="user-name"><?php echo htmlspecialchars($user['name']);?></h2>
            <p class="user-role" id="user-role">(<?php echo ucfirst($user['role']);?>)</p>
        </div>
        <nav>
            <a href="dashboard.php" target="content-frame">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="borrowed-books.php" target="content-frame">
                <span class="material-symbols-outlined">book_5</span>
                <span>Borrowed Books</span>
            </a>
            <a href="reserved-books.php" target="content-frame">
                <span class="material-symbols-outlined">collections_bookmark</span>
                <span>Reserved Books</span>
            </a>
            <a href="change-password.php" target="content-frame">
                <span class="material-symbols-outlined">lock</span>
                <span>Change Password</span>
            </a>
            <a href="profile.php" target="content-frame">
                <span class="material-symbols-outlined">person</span>
                <span>Profile</span>
            </a>
            <a href="../../backend/logout.php">
                <span class="material-symbols-outlined">logout</span>
                <span>Logout</span>
            </a>
            
            
            
        </nav>
    </div>

    <div class="main-container">
        <header>
            <div class="logo-container">
                <img src="../images/logo.svg" alt="">
                <h1 class="logo">Lexora</h1>
            </div>
        </header>
        <iframe class="content" name="content-frame" src="dashboard.php"></iframe>
    </div>

</body>

</html>