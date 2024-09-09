<?php
// Start session to manage user login state
session_start();

// Simulated user credentials (you can replace this with database validation)
$valid_username = "admin";
$valid_password = "bright123";

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Validate credentials
if ($username === $valid_username && $password === $valid_password) {
    // Set session to store username
    $_SESSION['username'] = $username;

    // Redirect to dashboard with welcome message
    header("Location: ./dashboard.php");
    exit();
} else {
    // Redirect back to login.php with an error message
    $error_message = "Username or Password is incorrect.";
    header("Location: ./login.php?error=" . urlencode($error_message));
    exit();
}
?>
