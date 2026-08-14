<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: /gull_boutique/admin/login.php");
    exit;
}
include __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - Gull Boutique</title>
<link rel="stylesheet" href="/gull_boutique/css/style.css">
</head>
<body>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <h2>Gull Admin</h2>
        <nav>
            <a href="/gull_boutique/admin/dashboard.php">Dashboard</a>
            <a href="/gull_boutique/admin/products.php">Products</a>
            <a href="/gull_boutique/admin/categories.php">Categories</a>
            <a href="/gull_boutique/admin/messages.php">Messages</a>
            <a href="/gull_boutique/admin/logout.php">Logout</a>
        </nav>
    </aside>
    <main class="admin-content">