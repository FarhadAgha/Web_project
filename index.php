<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<section class="hero">
    <h1>Elegance for Every Woman</h1>
    <p>Discover Gull Boutique's curated collection of dresses, bags, and accessories.</p>
    <a href="/gull_boutique/products.php" class="btn-primary">Shop Now</a>
</section>

<section class="featured">
    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php
        $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="product-img-wrap">';
                echo '<span class="card-badge">' . htmlspecialchars($row['category_name'] ?? 'New') . '</span>';
                echo '<img src="/gull_boutique/images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '</a>';
                echo '<div class="product-info">';
                echo '<h3><a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></h3>';
                echo '<p class="price">$' . htmlspecialchars($row['price']) . '</p>';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="btn-view">View Details</a>';
                echo '</div></div>';
                }
        } else {
            echo '<p>No products yet — add some from the admin panel!</p>';
        }
        ?>
    </div>
</section>

<section class="about-teaser">
    <h2>About Gull Boutique</h2>
    <p>We bring timeless style and modern elegance together, curated for women who know what they want.</p>
    <a href="/gull_boutique/about.php" class="btn-primary">Learn More</a>
</section>

<?php include 'includes/footer.php'; ?>