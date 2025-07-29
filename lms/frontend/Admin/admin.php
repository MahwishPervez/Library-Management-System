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
    <title>Admin | Lexora - Your Library, Anytime, Anywhere.</title>

</head>

<body>
    <div class="sidebar">
        <div class="user-info">
            <h2 class="user-name" id="user-name"><?php echo htmlspecialchars($user['name']);?></h2>
            <p class="user-role">(Admin)</p>
        </div>
        <nav>
            <a href="dashboard.php" target="content-frame">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="manage-students.php" target="content-frame">
                <span class="material-symbols-outlined">group</span>
                <span>Students</span>
            </a>
            <a href="manage-teachers.php" target="content-frame">
                <span class="material-symbols-outlined">supervisor_account</span>
                <span>Teachers</span>
            </a>
            <a href="manage-librarians.php" target="content-frame">
                <span class="material-symbols-outlined">supervisor_account</span>
                <span>Librarians</span>
            </a>
            <a href="add-user.php" target="content-frame">
                <span class="material-symbols-outlined">person_add</span>
                <span>Add User</span>
            </a>
            <a href="change-password.php" target="content-frame">
                <span class="material-symbols-outlined">lock</span>
                <span>Change Password</span>
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