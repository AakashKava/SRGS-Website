<?php
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/auth.php';

$id = $_POST['service_id'];
$title = $_POST['title'];
// $slug = strtolower(str_replace(' ', '-', $title));
$slug = strtolower(trim($title));
$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
$slug = trim($slug, '-');

// UPDATE SERVICE
// mysqli_query($conn, "UPDATE services SET title='$title', slug='$slug' WHERE id=$id");
$stmt = $conn->prepare("UPDATE services SET title=?, slug=? WHERE id=?");
$stmt->bind_param("ssi", $title, $slug, $id);
$stmt->execute();

// DELETE OLD ITEMS
mysqli_query($conn, "DELETE FROM service_items WHERE service_id=$id");

// INSERT NEW ITEMS
if (!empty($_POST['items'])) {
    foreach ($_POST['items'] as $item) {
        if (!empty($item)) {
            mysqli_query($conn, "INSERT INTO service_items (service_id, title) VALUES ($id, '$item')");
        }
    }
}

header("Location: service.php");
exit;