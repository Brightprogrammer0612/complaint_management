<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "complaint_management";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$report_data = 'report_data';  

$query = "SELECT * FROM reports WHERE report_data = ? LIMIT 0, 25";
$stmt = $conn->prepare($query);

$stmt->bind_param('s', $report_data); 

$stmt->execute();

$result = $stmt->get_result();

if ($result) {
    $reports = $result->fetch_all(MYSQLI_ASSOC);
    echo "<pre>";
    print_r($reports);  
    echo "</pre>";
} else {
    echo "No reports found.";
}

$stmt->close();
$conn->close(); 
?>
