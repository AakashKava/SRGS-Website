<?php 
include 'includes/admin-header.php'; 
include 'includes/admin-sidebar.php'; 

$result = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC");
?>

<div class="admin-content">
    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i data-feather="menu"></i>
            </button>

            <h5 class="mb-0 fw-600">Contact Messages</h5>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow-sm">
        <div class="table-responsive">
            <table class="table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Message</th>
                <th>Date</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td class="text-nowrap"><?= htmlspecialchars($row['name']) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($row['email']) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($row['service']) ?></td>
                <td style="min-width: 200px;"><?= htmlspecialchars($row['message']) ?></td>
                <td class="text-nowrap"><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
            </table>
        </div>
    </div>

</div>

<?php include 'includes/admin-footer.php'; ?>