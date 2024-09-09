<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ./login.php');
    exit();
}

$complaint_id = $_GET['id'];
$new_status = $_GET['status'];

$sql = "UPDATE complaints SET status='$new_status' WHERE id='$complaint_id'";
if ($conn->query($sql) === TRUE) {
    echo "Complaint status updated.";
} else {
    echo "Error updating complaint: " . $conn->error;
}

header('Location: ./admin_complaints.php');
$conn->close();
?>
