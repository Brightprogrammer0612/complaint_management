<?php
session_start();
ob_start();
include('./includes/header.php');
include('./includes/db.php');

if (isset($_POST['submit'])) {
    echo "Form submitted!"; // Debugging line

    $user_id = $_POST['user_id'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    
    echo "User ID: $user_id"; // Debugging line
    
    try {
        // Check if user_id exists in the users table
        $checkUserQuery = "SELECT id FROM users WHERE id = ?";
        $checkStmt = $conn->prepare($checkUserQuery);
        if (!$checkStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $checkStmt->bind_param("i", $user_id); // User ID is an integer
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // If user exists, insert the complaint
            $query = "INSERT INTO complaints (user_id, type, status) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("iss", $user_id, $type, $status); // Corrected parameter types (int for user_id)
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            $stmt->close();
            echo "Complaint submitted successfully!";
        } else {
            echo "Error: User ID $user_id does not exist in the users table.";
        }

        $checkStmt->close();
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Management System</title>
  <link href="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
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
    .content {
      margin-left: 240px; 
      padding: 20px;
    }

    .form-control {
      max-width: 400px;
    }

    .btn-custom {
      background-color: #1abc9c;
      color: white;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }

  </style>
</head>
 <body class="light-theme">
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

<main class="content" style="width: 82%;">
  <div class="card mb-4" >
    <div class="card-header">
      <h5>Add New Complaint</h5>
    </div>
    <div class="card-body">
      <form action="./complaints.php" method="POST">
        <div class="mb-3">
          <label for="user_id" class="form-label">User ID</label>
          <input type="number" class="form-control" id="user_id" name="user_id" required>
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Complaint Type</label>
          <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Complaint Status</label>
          <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <button type="submit" name="submit" class="btn btn-custom">Submit Complaint</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5>Complaints List</h5>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Type</th>
            <th>Status</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($complaints)): ?>
            <?php foreach ($complaints as $complaint): ?>
              <tr>
                <td><?= htmlspecialchars($complaint['id']) ?></td>
                <td><?= htmlspecialchars($complaint['user_id']) ?></td>
                <td><?= htmlspecialchars($complaint['type']) ?></td>
                <td><?= htmlspecialchars($complaint['status']) ?></td>
                <td><?= htmlspecialchars($complaint['description']) ?></td>
                <td>
                  <a href="edit_complaint.php?id=<?= htmlspecialchars($complaint['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="delete_complaint.php?id=<?= htmlspecialchars($complaint['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">No complaints found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<script src="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php include './includes/footer.php'; ?>
