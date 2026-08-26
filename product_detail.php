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

// Handle new review submission
$reviewError = '';
$reviewSuccess = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $reviewerName = trim($_POST['reviewer_name']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    if ($reviewerName && $rating >= 1 && $rating <= 5) {
        $stmt2 = $conn->prepare("INSERT INTO reviews (product_id, reviewer_name, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isis", $id, $reviewerName, $rating, $comment);
        $stmt2->execute();
        $reviewSuccess = "Thank you for your review!";
    } else {
        $reviewError = "Please enter your name and select a rating.";
    }
}

// Get reviews + average rating
$reviewStmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
$reviewStmt->bind_param("i", $id);
$reviewStmt->execute();
$reviews = $reviewStmt->get_result();

$avgStmt = $conn->prepare("SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM reviews WHERE product_id = ?");
$avgStmt->bind_param("i", $id);
$avgStmt->execute();
$avgData = $avgStmt->get_result()->fetch_assoc();
$avgRating = round($avgData['avg_rating'] ?? 0, 1);
$reviewCount = $avgData['review_count'] ?? 0;

// Related products (same category, excluding current)
$relatedStmt = $conn->prepare("SELECT products.*, categories.name AS category_name 
                                FROM products 
                                LEFT JOIN categories ON products.category_id = categories.id 
                                WHERE products.category_id = ? AND products.id != ? 
                                ORDER BY products.created_at DESC LIMIT 4");
$relatedStmt->bind_param("ii", $product['category_id'], $id);
$relatedStmt->execute();
$related = $relatedStmt->get_result();

function renderStars($rating) {
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= round($rating) ? '★' : '☆';
    }
    return $html;
}
?>

<section class="product-detail">
    <div class="detail-image">
        <img src="/gull_boutique/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    </div>
    <div class="detail-info">
        <span class="detail-category"><?php echo htmlspecialchars($product['category_name']); ?></span>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>

        <div class="detail-rating">
            <span class="stars"><?php echo renderStars($avgRating); ?></span>
            <span class="rating-text"><?php echo $avgRating > 0 ? $avgRating . ' out of 5' : 'No reviews yet'; ?> (<?php echo $reviewCount; ?> review<?php echo $reviewCount != 1 ? 's' : ''; ?>)</span>
        </div>

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

<?php if ($related->num_rows > 0): ?>
<section class="featured">
    <h2>Related Products</h2>
    <div class="product-grid">
        <?php while ($row = $related->fetch_assoc()): ?>
            <div class="product-card">
                <a href="/gull_boutique/product_detail.php?id=<?php echo $row['id']; ?>" class="product-img-wrap">
                    <span class="card-badge"><?php echo htmlspecialchars($row['category_name'] ?? 'New'); ?></span>
                    <button class="wishlist-heart" data-id="<?php echo $row['id']; ?>">♡</button>
                    <img src="/gull_boutique/images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="product-info">
                    <h3><a href="/gull_boutique/product_detail.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></a></h3>
                    <p class="price">Rs. <?php echo number_format($row['price']); ?></p>
                    <a href="/gull_boutique/product_detail.php?id=<?php echo $row['id']; ?>" class="btn-view">View Details</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>

<section class="reviews-section">
    <h2>Customer Reviews</h2>

    <?php if ($reviewSuccess): ?><p class="form-success"><?php echo htmlspecialchars($reviewSuccess); ?></p><?php endif; ?>
    <?php if ($reviewError): ?><p class="form-error"><?php echo htmlspecialchars($reviewError); ?></p><?php endif; ?>

    <form method="POST" action="product_detail.php?id=<?php echo $id; ?>" class="review-form">
        <label>Your Name</label>
        <input type="text" name="reviewer_name" required>

        <label>Rating</label>
        <select name="rating" required>
            <option value="">Select a rating</option>
            <option value="5">★★★★★ (5)</option>
            <option value="4">★★★★☆ (4)</option>
            <option value="3">★★★☆☆ (3)</option>
            <option value="2">★★☆☆☆ (2)</option>
            <option value="1">★☆☆☆☆ (1)</option>
        </select>

        <label>Comment (optional)</label>
        <textarea name="comment" rows="3"></textarea>

        <button type="submit" name="submit_review" class="btn-primary">Submit Review</button>
    </form>

    <div class="review-list">
        <?php if ($reviews->num_rows > 0): ?>
            <?php while ($rev = $reviews->fetch_assoc()): ?>
                <div class="review-item">
                    <div class="review-header">
                        <strong><?php echo htmlspecialchars($rev['reviewer_name']); ?></strong>
                        <span class="stars"><?php echo renderStars($rev['rating']); ?></span>
                    </div>
                    <?php if ($rev['comment']): ?>
                        <p><?php echo htmlspecialchars($rev['comment']); ?></p>
                    <?php endif; ?>
                    <span class="review-date"><?php echo date("M j, Y", strtotime($rev['created_at'])); ?></span>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No reviews yet — be the first to review this product!</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>