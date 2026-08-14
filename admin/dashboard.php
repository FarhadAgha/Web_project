<?php include '../includes/admin_header.php'; ?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>
<p>Use the sidebar to manage Products, Categories, and view Contact Messages.</p>

<div class="dashboard-stats">
    <?php
    $productCount = $conn->query("SELECT COUNT(*) as c FROM products")->fetch_assoc()['c'];
    $categoryCount = $conn->query("SELECT COUNT(*) as c FROM categories")->fetch_assoc()['c'];
    $messageCount = $conn->query("SELECT COUNT(*) as c FROM contact_messages")->fetch_assoc()['c'];
    ?>
    <div class="stat-card"><h3><?php echo $productCount; ?></h3><p>Products</p></div>
    <div class="stat-card"><h3><?php echo $categoryCount; ?></h3><p>Categories</p></div>
    <div class="stat-card"><h3><?php echo $messageCount; ?></h3><p>Messages</p></div>
</div>

<?php include '../includes/admin_footer.php'; ?>