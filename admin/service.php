<?php 

// include $_SERVER['DOCUMENT_ROOT'] . '/SRGS/includes/db.php';
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    $stmt = $conn->prepare("INSERT INTO services (title, slug) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $slug);
    $stmt->execute();

    $service_id = $stmt->insert_id;

    if (!empty($_POST['items'])) {
        foreach ($_POST['items'] as $item) {
            if (!empty($item)) {
                $stmt2 = $conn->prepare("INSERT INTO service_items (service_id, title) VALUES (?, ?)");
                $stmt2->bind_param("is", $service_id, $item);
                $stmt2->execute();
            }
        }
    }

    header("Location: service.php");
    exit;
}
?>

<?php 
include 'includes/admin-header.php'; 
include 'includes/admin-sidebar.php'; 

$services = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
?>

<div class="admin-content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i data-feather="menu"></i>
            </button>

            <h5 class="mb-0 fw-600">Services</h5>
        </div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            + Add Service
        </button>
    </div>

    <!-- LIST -->
    <div class="bg-white p-4 rounded shadow-sm">

        <?php while($service = mysqli_fetch_assoc($services)): ?>

            <div class="service-row mb-4 p-3 border rounded">

                <!-- TITLE -->
                <h6 class="fw-bold"><?= $service['title'] ?></h6>

                <!-- ITEMS -->
                <ul class="mb-2">
                    <?php
                    $items = mysqli_query($conn, "SELECT * FROM service_items WHERE service_id=".$service['id']);
                    while($item = mysqli_fetch_assoc($items)):
                    ?>
                        <li><?= $item['title'] ?></li>
                    <?php endwhile; ?>
                </ul>

                <!-- ACTION -->
                <div>
                    <button class="btn btn-sm btn-primary edit-btn"
                            data-id="<?= $service['id'] ?>"
                            data-title="<?= htmlspecialchars($service['title']) ?>">
                        Edit
                    </button>

                    <a href="delete-service.php?id=<?= $service['id'] ?>" 
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this service?')">
                    Delete
                    </a>
                </div>

            </div>

        <?php endwhile; ?>

    </div>

</div>

<!-- ADD SERVICE MODAL -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form method="POST">

                    <input type="text" name="title" class="form-control mb-3" placeholder="Service Title" required>

                    <div id="items-wrapper">
                        <input type="text" name="items[]" class="form-control mb-2" placeholder="Item">
                    </div>

                    <button type="button" onclick="addItem()" class="btn btn-sm btn-secondary mb-3">
                        + Add Item
                    </button>

                    <button class="btn btn-dark w-100">Save</button>

                </form>

            </div>

        </div>
    </div>
</div>

<!-- EDIT SERVICE MODAL -->
<div class="modal fade" id="editServiceModal">
    <div class="modal-dialog">
        <div class="modal-content p-3">

            <h5>Edit Service</h5>

            <form method="POST" action="edit-service.php">

                <input type="hidden" name="service_id" id="edit-service-id">

                <input type="text" name="title" id="edit-title" class="form-control mb-3">

                <div id="edit-items-wrapper"></div>

                <button type="button" onclick="addEditItem()" class="btn btn-sm btn-secondary mb-3">
                    + Add Item
                </button>

                <button class="btn btn-dark w-100">Update</button>

            </form>

        </div>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>