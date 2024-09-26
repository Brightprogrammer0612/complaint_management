<?php 
session_start();
include('./includes/header.php'); 
include('./includes/db.php'); 

$complaints = [];
$filters = '';
$params = [];
$types = '';

if (isset($_GET['filter_type']) && !empty($_GET['filter_type'])) {
    $filters .= " WHERE type = ?";
    $params[] = $_GET['filter_type'];
    $types = 's'; 
}

try {
    $query = "SELECT * FROM complaints $filters";
    $stmt = $conn->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param($types, $params[0]);
    }

    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result) {
        $complaints = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Error retrieving complaints data.";
    }

    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body.light-theme {
            background-color: #ffffff;
            color: #000000;
        }
        body.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
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
    <main class="content" style="height: 79vh;">
        <div class="container mt-4">
            <h2>Reports</h2>
            <form method="GET" class="mb-3">
                <select name="filter_type" class="form-select">
                    <option value="">Select Type</option>
                    <option value="technical" <?= isset($_GET['filter_type']) && $_GET['filter_type'] == 'technical' ? 'selected' : '' ?>>Technical</option>
                    <option value="service" <?= isset($_GET['filter_type']) && $_GET['filter_type'] == 'service' ? 'selected' : '' ?>>Service</option>
                    <option value="billing" <?= isset($_GET['filter_type']) && $_GET['filter_type'] == 'billing' ? 'selected' : '' ?>>Billing</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($complaints) > 0): ?>
                        <?php foreach ($complaints as $complaint): ?>
                        <tr>
                            <td><?= htmlspecialchars($complaint['id']) ?></td>
                            <td><?= htmlspecialchars($complaint['user_id']) ?></td>
                            <td><?= htmlspecialchars($complaint['type']) ?></td>
                            <td><?= htmlspecialchars($complaint['status']) ?></td>
                            <td><?= htmlspecialchars($complaint['description']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No complaints found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
    <script src="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
