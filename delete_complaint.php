<?php
include('./includes/db.php');

if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];
    
    $deleteQuery = "DELETE FROM complaints WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $complaint_id);
    
    if ($stmt->execute()) {
        header("Location: ./complaints.php");
    } else {
        echo "Error deleting complaint.";
    }
}
?>
