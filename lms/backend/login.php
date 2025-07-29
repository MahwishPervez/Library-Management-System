<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $role = mysqli_real_escape_string($conn, $role);

    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        
        echo "<script>alert('No account found with this email!'); window.location.href = '../frontend/login.php';</script>";
        exit();
    }

    
    $user = $result->fetch_assoc();

    
    if ($user['password'] !== $password) {
        echo "<script>alert('Incorrect password! Please try again.'); window.location.href = '../frontend/login.php';</script>";
        exit();
    }

    
    if ($user['role'] !== $role) {
        echo "<script>alert('No user found with this role!'); window.location.href = '../frontend/login.php';</script>";
        exit();
    }

    
    $_SESSION['user'] = $user;

    
    if ($role === "student" || $role === "teacher") {
        header("Location: ../frontend/User/user.php");
    } elseif ($role === "librarian") {
        header("Location: ../frontend/Librarian/librarian.php");
    } elseif ($role === "admin") {
        header("Location: ../frontend/Admin/admin.php");
    }
    exit();
}
?>
