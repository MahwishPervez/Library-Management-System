<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

echo json_encode($_SESSION['user']);
?>
