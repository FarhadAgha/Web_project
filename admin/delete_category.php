<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
include '../includes/db.php';

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    // Check if any products use this category
    $check = $conn->prepare("SELECT COUNT(*) as c FROM products WHERE category_id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $count = $check->get_result()->fetch_assoc()['c'];

    if ($count > 0) {
        header("Location: categories.php?error=inuse");
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: categories.php");
exit;
?>