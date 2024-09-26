<?php
session_start();

$valid_username = "admin";
$valid_password = "bright123";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['username'] = $username;

    header("Location: ./dashboard.php");
    exit();
} else {
    $error_message = "Username or Password is incorrect.";
    header("Location: ./login.php?error=" . urlencode($error_message));
    exit();
}
?>
