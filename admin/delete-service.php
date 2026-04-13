<?php
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/auth.php';

// $id = $_GET['id'];

// mysqli_query($conn, "DELETE FROM services WHERE id=$id");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM services WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: service.php");
exit;