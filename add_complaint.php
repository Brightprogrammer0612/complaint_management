<?php
include './includes/db.php';
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaint_text = $conn->real_escape_string($_POST['complaint_text']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO complaints (user_id, complaint_text, status) 
            VALUES ('$user_id', '$complaint_text', 'open')";

    if ($conn->query($sql) === TRUE) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: ./complaints.php');
}
$conn->close();
?>
