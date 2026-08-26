<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
include '../includes/db.php';

$id = intval($_POST['id'] ?? 0);

if ($id > 0 && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageName = 'cat_' . time() . '_' . basename($_FILES['image']['name']);
    $targetPath = '../images/' . $imageName;
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    if (in_array($_FILES['image']['type'], $allowedTypes)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        $stmt = $conn->prepare("UPDATE categories SET image = ? WHERE id = ?");
        $stmt->bind_param("si", $imageName, $id);
        $stmt->execute();
    }
}

header("Location: categories.php");
exit;
?>