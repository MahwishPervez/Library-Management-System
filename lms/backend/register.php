<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $university_id = $conn->real_escape_string($_POST['university-id']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = $conn->real_escape_string($_POST['role']);

    
    $sql = "INSERT INTO users (name, email, password, university_id, phone, role) 
            VALUES ('$name', '$email', '$password', '$university_id', $phone, '$role')";

    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration Successful! You may login now.');
                window.location.href = '../frontend/login.php'; 
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }

    
    $conn->close();
}
?>
