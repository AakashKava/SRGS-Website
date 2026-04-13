<?php 
include 'includes/admin-header.php';
include 'includes/admin-sidebar.php'; 
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/auth.php';

// COUNT SERVICES
$service_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM services");
$service_count = mysqli_fetch_assoc($service_count)['total'];

// COUNT PROJECTS
// $project_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM projects");
// $project_count = mysqli_fetch_assoc($project_count)['total'];

// COUNT CONTACTS
$contact_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM contacts");
$contact_count = mysqli_fetch_assoc($contact_count)['total'];

?>

<div class="admin-content">

    <div class="topbar">

    <div class="d-flex justify-content-between align-items-center">

        <!-- LEFT -->
        <div class="d-flex align-items-center gap-3">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i data-feather="menu"></i>
            </button>

            <h5 class="mb-0 fw-600">Dashboard</h5>
        </div>

        <!-- RIGHT -->
        <div class="d-flex align-items-center gap-3">
            <a href="logout.php" class="logout-btn">
                Logout
            </a>
        </div>

    </div>

</div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="p-4 bg-white rounded shadow-sm shadow-sm border-4 border-start border-success">
                <div class="d-flex align-items-center gap-2">
                    <i data-feather="grid"></i>
                    <h6>Total Services:</h6>
                    <h2><?= $service_count ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="p-4 bg-white rounded shadow-sm border-4 border-start border-danger">
                <div class="d-flex align-items-center gap-2">
                    <i data-feather="folder"></i>
                    <h6>Total Projects:</h6>
                    <!-- <h2><?= $project_count ?></h2> -->
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="p-4 bg-white rounded shadow-sm border-4 border-start border-warning">
                <div class="d-flex align-items-center gap-2">
                    <i data-feather="mail"></i>
                    <h6>Total Contacts:</h6>
                    <h2><?= $contact_count ?></h2>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'includes/admin-footer.php'; ?>