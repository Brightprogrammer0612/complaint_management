<?php include './includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Complaint Management System</title>
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

    .greeting {
      text-align: center;
      margin-top: 100px;
    }

    .greeting img {
      max-width: 300px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="light-theme">
  <div id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
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
        <a class="nav-link" href="UserManagement.php">
          <i class="bi bi-person"></i> User Management
        </a>
      </ul>
    </div>
  </div>

  <div class="content">
    <div class="greeting">
      <h1>Hi there!</h1>
      <p>Dashboard, shortcuts, and analytics will come soon.</p>
      <img src="../complaint_management/assets/images/Landing_Page-removebg-preview.png" alt="Placeholder image">
    </div>
  </div>
  <script src="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
<?php include './includes/footer.php'; ?>
