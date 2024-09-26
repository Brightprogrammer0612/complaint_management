<?php
ob_start(); 
session_start();
include('./includes/db.php');
include('./includes/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}

if (!isset($_SESSION['role'])) {
    echo "Access denied! User role not defined.";
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    echo "Access denied! You do not have sufficient permissions.";
    exit();
}

try {
    $stmt = $db->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching users: " . $e->getMessage();
    exit();
}

ob_end_flush(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Complaint Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .login-box {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .content {
            margin-left: 220px;
        }
        .sidebar {
            background-color: #4CAF50;
            min-height: 100vh;
            padding-top: 20px;
            color: white;
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
        .sidebar .nav-link {
            color: white;
            margin: 10px 0;
        }
        .sidebar .nav-link.active {
            background-color: #3a9e48;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
        }
        .table thead {
            background-color: #4CAF50;
            color: white;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
<div>
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

    <div class="container mt-4 content">
        <h2>User Management</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_user.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
