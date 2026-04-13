<?php
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/auth.php';

// $id = $_GET['id'];
// $result = mysqli_query($conn, "SELECT * FROM service_items WHERE service_id=$id");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM service_items WHERE service_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);