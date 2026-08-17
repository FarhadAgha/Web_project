<?php session_start(); ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<section class="page-header">
    <h1>My Wishlist</h1>
</section>

<section class="featured">
    <div class="product-grid">
        <?php
        $wishlist = $_SESSION['wishlist'] ?? [];

        if (count($wishlist) > 0) {
            $placeholders = implode(',', array_fill(0, count($wishlist), '?'));
            $types = str_repeat('i', count($wishlist));
            $stmt = $conn->prepare("SELECT products.*, categories.name AS category_name 
                                     FROM products 
                                     LEFT JOIN categories ON products.category_id = categories.id 
                                     WHERE products.id IN ($placeholders)");
            $stmt->bind_param($types, ...$wishlist);
            $stmt->execute();
            $result = $stmt->get_result();

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
            echo '<p>Your wishlist is empty. Browse our <a href="/gull_boutique/products.php">Products</a> and click the heart icon to save items you love.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>