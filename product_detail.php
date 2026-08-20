<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT products.*, categories.name AS category_name 
                         FROM products 
                         LEFT JOIN categories ON products.category_id = categories.id 
                         WHERE products.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo '<p style="text-align:center; padding:60px;">Product not found.</p>';
    include 'includes/footer.php';
    exit;
}
?>

<section class="product-detail">
    <div class="detail-image">
        <img src="/gull_boutique/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    </div>
    <div class="detail-info">
        <span class="detail-category"><?php echo htmlspecialchars($product['category_name']); ?></span>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="detail-price">Rs. <?php echo number_format($product['price']); ?></p>
        <p class="detail-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        <p class="detail-stock">
            <?php if ($product['stock'] > 0): ?>
                <span class="in-stock">In Stock (<?php echo $product['stock']; ?> available)</span>
            <?php else: ?>
                <span class="out-stock">Out of Stock</span>
            <?php endif; ?>
        </p>
        <a href="/gull_boutique/products.php" class="btn-primary">← Back to Products</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>