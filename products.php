<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<section class="page-header">
    <h1>Our Products</h1>
</section>

<section class="filter-bar">
    <?php
    $catQuery = $conn->query("SELECT * FROM categories ORDER BY name");
    $selectedCat = isset($_GET['category']) ? intval($_GET['category']) : 0;
    ?>
    <a href="products.php" class="filter-btn <?php echo $selectedCat === 0 ? 'active' : ''; ?>">All</a>
    <?php while ($cat = $catQuery->fetch_assoc()): ?>
        <a href="products.php?category=<?php echo $cat['id']; ?>"
           class="filter-btn <?php echo $selectedCat === (int)$cat['id'] ? 'active' : ''; ?>">
            <?php echo htmlspecialchars($cat['name']); ?>
        </a>
    <?php endwhile; ?>
</section>

<section class="featured">
    <div class="product-grid">
        <?php
        $searchTerm = trim($_GET['search'] ?? '');

        if ($searchTerm !== '') {
            $likeTerm = '%' . $searchTerm . '%';
            $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? ORDER BY created_at DESC");
            $stmt->bind_param("s", $likeTerm);
            $stmt->execute();
            $result = $stmt->get_result();
        } elseif ($selectedCat > 0) {
            $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
            $stmt->bind_param("i", $selectedCat);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
        }

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="product-img-wrap">';
                echo '<span class="card-badge">' . htmlspecialchars($row['category_name'] ?? 'New') . '</span>';
                echo '<button class="wishlist-heart" data-id="' . $row['id'] . '">♡</button>';
                echo '<img src="/gull_boutique/images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '</a>';
                echo '<div class="product-info">';
                echo '<h3><a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></h3>';
                echo '<p class="price">Rs. ' . number_format($row['price']) . '</p>';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="btn-view">View Details</a>';
                echo '</div></div>';
            }
        } else {
            echo '<p>No products found in this category yet.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>