<?php
include ('./includes/header.php');
include('./includes/db.php');

if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];
    
    if (isset($_POST['update'])) {
        $type = $_POST['type'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        
        $updateQuery = "UPDATE complaints SET type = ?, status = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssi", $type, $status, $description, $complaint_id);
        
        if ($stmt->execute()) {
            echo "Complaint updated successfully!";
            header("Location: ./complaints.php");
        } else {
            echo "Error updating complaint.";
        }
    }

    $complaintQuery = "SELECT * FROM complaints WHERE id = ?";
    $stmt = $conn->prepare($complaintQuery);
    $stmt->bind_param("i", $complaint_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $complaint = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Complaint</title>
  <link href="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body.light-theme {
      background-color: #ffffff;
      color: #000000;
    }

    body.dark-theme {
      background-color: #343a40;
      color: #f8f9fa;
    }

    .navbar.light-theme {
      background-color: #f8f9fa;
    }

    .navbar.dark-theme {
      background-color: #343a40;
    }

    .form-control {
      max-width: 400px;
    }

    #sidebar {
      background-color: #f8f9fa;
      min-height: 100vh;
      padding-top: 20px;
      padding-left: 10px;
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
    }

    #sidebar .title {
      display: flex;
      align-items: center;
      text-align: center;
      margin-bottom: 20px;
    }

    #sidebar .title img {
      max-width: 100px;
      margin-right: 10px;
    }
    #sidebar .title h5 {
      font-size: 1.5rem;
      margin: 0;
    }

    #sidebar .title p {
      margin: 0;
      font-size: 0.875rem;
    }

    #sidebar .nav-link {
      color: #333;
      padding: 15px;
      text-decoration: none;
      display: block;
    }

    #sidebar .nav-link.active {
      background-color: #1abc9c;
      color: white;
    }

    #sidebar .nav-link:hover {
      background-color: #1abc9c;
      color: white;
    }

    .content {
      margin-left: 240px; 
      padding: 20px;
    }

    .navbar-custom {
      background-color: #1abc9c;
    }

    .navbar-custom .navbar-brand, 
    .navbar-custom .navbar-text, 
    .navbar-custom .navbar-nav .nav-link {
      color: white;
    }
    </style>
</head>
<body>
<div id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="title">
      <img src="./assets/images/logo.png" alt="Company Logo" width="40" height="40"> 
      <div>
        <h6>Complaint Management</h6>
        <p>Simple | Reliable | Efficient</p>
      </div>
    </div>
    <div class="position-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="bi bi-house"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="complaints.php">
            <i class="bi bi-file-earmark-text"></i> Complaints
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">
            <i class="bi bi-bar-chart"></i> Reports
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="UserManagement.php">
            <i class="bi bi-person"></i> User Management
          </a>
        </li>
      </ul>
    </div>
  </div>
  <main class="content" >
  <div class="container mt-5">
    <h3>Edit Complaint</h3>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="type" class="form-label">Complaint Type</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($complaint['type']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Complaint Status</label>
        <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($complaint['status']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($complaint['description']) ?></textarea>
      </div>
      <button type="submit" name="update" class="btn btn-primary">Update Complaint</button>
    </form>
  </div>
  </main>
</body>
</html>
<?php include './includes/footer.php'; ?>