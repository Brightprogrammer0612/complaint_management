<?php
include './db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ./login.php');
    exit();
}

$sql = "SELECT complaints.id, users.username, complaints.complaint_text, complaints.status, complaints.created_at 
        FROM complaints 
        JOIN users ON complaints.user_id = users.id 
        ORDER BY complaints.created_at DESC";
$result = $conn->query($sql);

include './includes/header.php'; 
?>

<h2>Complaints Management</h2>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Complaint</th>
            <th>Status</th>
            <th>Submitted At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['complaint_text'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <?php if ($row['status'] === 'open'): ?>
                            <a href="update_complaint.php?id=<?= $row['id'] ?>&status=in_progress" class="btn btn-warning">In Progress</a>
                        <?php elseif ($row['status'] === 'in_progress'): ?>
                            <a href="update_complaint.php?id=<?= $row['id'] ?>&status=closed" class="btn btn-success">Close</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No complaints found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include './footer.php'; ?>
