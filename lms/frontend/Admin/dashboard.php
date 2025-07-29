<?php
session_start();
include '../../backend/db.php'; 


if (!isset($_SESSION['user'])) {
    echo "User not logged in!";
    exit();
}

$user = $_SESSION['user']; 


$sqlTotalUsers = "SELECT COUNT(*) AS  total_users FROM users";
$resultTotalUsers = $conn->query($sqlTotalUsers);
$totalUsers = ($resultTotalUsers) ? $resultTotalUsers->fetch_assoc()['total_users'] : 0;


$sqlStudents = "SELECT COUNT(*) AS students FROM users WHERE role='student'";
$resultStudents = $conn->query($sqlStudents);
$students = ($resultStudents) ? $resultStudents->fetch_assoc()['students'] : 0;


$sqlTeachers = "SELECT COUNT(*) AS teachers FROM users WHERE role='teacher'";
$resultTeachers = $conn->query($sqlTeachers);
$teachers = ($resultTeachers) ? $resultTeachers->fetch_assoc()['teachers'] : 0;


$sqlLibrarians= "SELECT COUNT(*) AS librarians FROM users WHERE role='librarian'";
$resultLibrarians = $conn->query($sqlLibrarians);
$librarians = ($resultLibrarians) ? $resultLibrarians->fetch_assoc()['librarians'] : 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div>
            <h3>Total Registered Users</h3>
            <h2><?php echo $totalUsers; ?></h2>
            <a href="all-users.php">View All</a>
        </div>
        <div>
            <h3>Students</h3>
            <h2><?php echo $students; ?></h2>
            <a href="manage-students.php">View All</a>
        </div>
        <div>
            <h3>Teachers</h3>
            <h2><?php echo $teachers; ?></h2>
            <a href="manage-teachers.php">View All</a>
        </div>
        <div>
            <h3>Librarians</h3>
            <h2><?php echo $librarians; ?></h2>
            <a href="manage-librarians.php">View All</a>
        </div>
        
    </section>
</body>
</html>